# Symfony example application

Application created to show some of my skills in coding.
Example implementation for Book module, which can retrieve 10 books for search criteria.
Exposed endpoints are in CLI and API Controller.

### Features

* It's NOT DDD! Classes are segregated for some visibility reason, but application not implementing Domain Driven Design - it's overkill at this stage
* Book module connects to OpenLibrary API. It can get 10 books and show them as an output for given search criteria (author, title). Searching cna be sorted ascending or descending
* CLI command (inside container) `php  bin/console app:open-library:search`
* Some empty unit tests to show what needs to be tested (not only success paths)

## Installation

1. If not already done, [install Docker Compose](https://docs.docker.com/compose/install/) (v2.10+)
2. Run `docker compose build --no-cache` to build fresh images
3. Run `docker compose up --pull always -d --wait` to start the project
4. Open `https://localhost` in your favorite web browser and [accept the auto-generated TLS certificate](https://stackoverflow.com/a/15076602/1352334)
5. Run `docker compose down --remove-orphans` to stop the Docker containers.

> More info: https://github.com/dunglas/symfony-docker

## FAQ

* Is application really working?
    > Yes! You can test it on your own! Just follow steps in installation section

* Why you don't wrote any tests?
    > I can create mocks, stubs, then write expectations for them and test real classes from project.

* How long did you prepare configuration for this project?
    > Most of the things are preconfigured (Symfony docker, PHP Unit, PHP CS Fixer). I've only added necessary things for my changes

* Will it be updated in future?
    > Maybe :)

