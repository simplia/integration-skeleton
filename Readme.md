## Install

Create empty directory for project, navigate to it and run one of the following commands:

```bash
# install with docker on Windows
docker run --rm -it -v %cd%:/app --workdir=/app thecodingmachine/php:8.1-v4-cli composer create-project simplia/integration-skeleton .

# install with docker on Linux
docker run --rm -it -v $(pwd):/app --workdir=/app thecodingmachine/php:8.1-v4-cli composer create-project simplia/integration-skeleton .

# or install with local PHP
composer create-project simplia/integration-skeleton .
```
