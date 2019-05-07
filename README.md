# Yii 3 kitchen sink

This is a Yii 3 project, created to test, document and showcase the new features
of the framework. You can see it running live on [https://yii3.idk.tn/](https://yii3.idk.tn/).

The source code is available at [machour/yii3-kitchen-sink](https://github.com/machour/yii3-kitchen-sink), and you
can be running it locally in a few seconds using `./yii serve` on your fresh copy.

> This originally started as a [Wiki post](https://www.yiiframework.com/wiki/2547/draft-understanding-yii-3)
> but the post was getting too long, and documenting Yii 3 using Yii 3 was too
> fun to not be done.

REQUIREMENTS
------------

The minimum requirement by this project template is that your Web server supports PHP 7.1.

INSTALLATION
------------

<div class="row">
<div class="col-md-6">

### Manually

1. Clone this project: `git clone git@github.com:machour/yii3-kitchen-sink.git`
2. Enter the project folder: `cd yii3-kitchen-sink`
3. Create a `.env` file: `cp .env.dist .env`
4. Install dependencies: `composer install`
5. Run the project: `./vendor/bin/yii serve`

You can now access it at [http://localhost:8080](http://localhost:8080)
</div>
<div class="col-md-6">

### Using docker

Perform steps 1 to 3 of the manual installation, and then:

4. Get a bash on the docker image: `docker-compose run --rm php bash`
5. Install dependencies: `composer install`
6. From your docker host, run: `docker-compose up -d`

You can now access the application at [http://localhost:30080](http://localhost:30080)
</div></div>

GRAPHS
------

In order to generate the dependencies graphs, you will need to:

```
# clone all yii3 repos under runtime/github
./yii github/clone
# generate the big graph
./yii packages/d3
# generate the small graphs
./yii packages/dependencies
# generate pdepends files
./yii packages/pdepends
```

You can update your checkouts by using `./yii github/pull` before generating the graphs again.
