# Run simplesamlphp as basic idp (for testing sp implementations)

## Setup

* Be able to run `docker-compose`
* `git submodules update --init` so that `simplesamlphp/` and
  `rocketchat/` are populated with code.
  * note: we don't actually use the checked out simplesaml code atm
  * and... you can run your rocketchat dev anywhere, doesn't have to be here
* make cert/keys: **idp** (simplesaml) cert/key and **sp** (rocketchat)
  * `cert/make.sh`
  * should create `cert/rocketchat.{pem,crt}`, `cert/simplesaml.{pem,crt}`
* add entries in `etc-hosts` to your `/etc/hosts`
* symlink or include either `apache.conf` or `nginx.conf` into your host webserver
* build simplesaml: `docker-compose build`

## Synopsis

Checkout whatever branch you want in `rocketchat`.

    cd rocketchat
    git checkout latest-amazing-saml-feature-branch

Start simplesaml and meteor/rocketchat:

    docker-compose up
    cd rocketchat && ADMIN_PASS=admin ADMIN_EMAIL=youremail@example.com meteor --port 3000

**Test**

* `http://simplesaml.local` should show a generic apache ubuntu page
* `http://simplesaml.local/simplesaml` should redirect to a installation page
* `http://rocketchat.local` should show your dev rocketchat

Configure rocketchat (login as admin):

* In http://rocketchat.local/admin/SAML

<pre><code>
    Enable                            = True
    Custom Provider                   = test-idp
    Custom Entry Point                = http://simplesaml.local/simplesaml/saml2/idp/SSOService.php
    SAML_IDP_SLO_Redirect_URL         = http://simplesaml.local/simplesaml/saml2/idp/SingleLogoutService.php
    Custom Issuer                     = http://rocketchat.local/_saml/metadata/test-idp
    Custom Certificate                = $(cert/get-raw-cert.sh cert/simplesaml.crt)
    SAML_Custom_Public_Cert_File_Path = $(pwd)/cert/rocketchat.crt
    SAML_Custom_Private_Key_File_Path = $(pwd)/cert/rocketchat.pem
    Button Text                       = SAML
</code></pre>

**Test**

* Open up a new (eg private) browser session to http://rocketchat.local .
* Try to login using SAML.
* Then log out.
* Then log in again.
  * did you have to authenticate with simplesaml this time?

### Changing signing / verification and encryption settings

* See `metadata/saml20-sp-remote.php`
* These settings determine **redirect querystring signing** and **encryption**:
  * `'assertion.encryption' => FALSE,`
  * `'redirect.sign' => TRUE,`
  * `'redirect.validate' => TRUE,`
  * see `simplesamlphp/docs/simplesamlphp-reference-sp-remote.md` for assertion and response signing settings

TODO: I think there is signing within the SAML assertions which is probably mandatory (not sure).
