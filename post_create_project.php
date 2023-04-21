<?php

file_put_contents(__DIR__ . '/Readme.md', <<<PHP
## Local development

See https://github.com/simplia/integration/blob/master/docs/local.md
PHP
);

$composer = json_decode(file_get_contents(__DIR__ . '/composer.json'), true, 512, JSON_THROW_ON_ERROR);

unset($composer['scripts']);

do {
    $authorName = readline('Author name: ');
    if (!preg_match('~^[a-z0-9]([_.-]?[a-z0-9]+)*/[a-z0-9](([_.]?|-{0,2})[a-z0-9]+)*$~', $projectName)) {
        echo 'Invalid namespace/name' . PHP_EOL;
        $projectName = null;
    }
} while (empty($authorName));

do {
    $authorEmail = readline('Author email: ');
    if (!filter_var($authorEmail, FILTER_VALIDATE_EMAIL)) {
        echo 'Invalid email' . PHP_EOL;
        $authorEmail = null;
    }
} while (empty($authorEmail));

do {
    $projectName = readline('Project namespace/name: ');
    // https://getcomposer.org/doc/04-schema.md#name
    if (!preg_match('~^[a-z0-9]([_.-]?[a-z0-9]+)*/[a-z0-9](([_.]?|-{0,2})[a-z0-9]+)*$~', $projectName)) {
        echo 'Invalid namespace/name' . PHP_EOL;
        $projectName = null;
    }
} while (empty($projectName));

$description = readline('Project description: ');

$composer['name'] = $projectName;
$composer['description'] = $description;
$composer['authors'] = [
    [
        'name' => $authorName,
        'email' => $authorEmail,
    ],
];

file_put_contents(__DIR__ . '/composer.json', json_encode($composer, JSON_THROW_ON_ERROR | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . PHP_EOL);

if (!mkdir($concurrentDirectory = __DIR__ . '/src') && !is_dir($concurrentDirectory)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
}
if (!mkdir($concurrentDirectory = __DIR__ . '/tests') && !is_dir($concurrentDirectory)) {
    throw new \RuntimeException(sprintf('Directory "%s" was not created', $concurrentDirectory));
}

unlink(__FILE__);
