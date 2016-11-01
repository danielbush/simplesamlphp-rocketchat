# Run simplesamlphp as basic idp (for testing sp implementations)

## Setup

* Be able to run `docker-compose`
* `git submodules update --init` so that `simplesamlphp/` and `rocketchat/` is populated with code
* create idp pub cert/key pair
  * `cd cert`
  * `./make.sh simplesaml`
    * `=> ./simplesaml.{crt,pem}`
* create sp pub cert/key pair for rocketchat
  * `cd cert`
  * `./make.sh rocketchat`
    * `=> ./rocketchat.{crt,pem}`

* build images: `docker-compose build`

* should build `simplesamlphp` image
* TODO: should build `rocketchat` image

## Synopsis

    docker-compose up

* `simplesaml` service should should show a generic apache ubuntu page on container port 80
  * `simplesaml/simplesaml` is the simplesamlphp endpoint
