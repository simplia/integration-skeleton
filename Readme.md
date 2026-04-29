## Install

Create empty directory for project, navigate to it and run one of the following commands:

```bash
# install with docker on Windows
docker run --rm -it -v %cd%:/app --workdir=/app thecodingmachine/php:8.4-v5-cli composer create-project --stability=dev simplia/integration-skeleton .

# install with docker on Linux
docker run --rm -it -v $(pwd):/app --workdir=/app thecodingmachine/php:8.4-v5-cli composer create-project --stability=dev simplia/integration-skeleton .

# or install with local PHP
composer create-project --stability=dev simplia/integration-skeleton .
```
