# Run simplesamlphp as basic idp (for testing Rocketchat implementations)

The **idp** will be a simplesaml container that we will run via
docker-compose and the **sp** will be rocketchat running in
development mode on your host.

## Setup


* run: `git submodules update --init` so that `simplesamlphp/` and
  `rocketchat/` are populated with code.
  * note: we don't actually use the checked out simplesaml code atm
  * and... you can run your rocketchat dev anywhere, doesn't have to be here
* make cert/keys: `cert/make.sh`
  * should create `cert/rocketchat.{pem,crt}`, `cert/simplesaml.{pem,crt}`
    so that simplesaml and rocketchat containers will be able to sign/verify and encrypt/decrypt
    saml assertions; (note: `saml.{pem,crt}` are a copy of `simplesaml.{pem,crt}` and
    are assumed by the simplesaml container)
* symlink or includ either `apache.conf` or `nginx.conf` into your host webserver and restart it
  so that your host webserver is configured as reverse proxy for simplesaml and rocketchat
* add entries in `etc-hosts` to your `/etc/hosts` so that your browser resolves correctly
* build simplesaml: `docker-compose build` (or `docker-compose build --pull`) so that the
  modified simplesamlphp image is built

## Synopsis

Checkout whatever branch you want in `rocketchat`.

    cd rocketchat
    git checkout latest-amazing-saml-feature-branch

Start simplesaml and meteor/rocketchat:

    docker-compose up
    cd rocketchat && ADMIN_PASS=admin ADMIN_EMAIL=youremail@example.com meteor --port 3000

**Test**

* `http://simplesaml.local` should show a generic apache ubuntu page
* `http://simplesaml.local/simplesaml` should redirect to a simplesaml "home" page
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

**Note:**

* `SAML_Custom_Public_Cert_File_Path`, `SAML_Custom_Private_Key_File_Path` and `SAML_IDP_SLO_Redirect_URL` are relatively new and may still be on feature branches.


**Test**

* Open up a new (eg private) browser session to http://rocketchat.local .
* Try to login using SAML button.
  * You should be taken to a simplesaml login screen.  Use `student/admin` see `config/authsources.php`.
* Then log out using the normal logout button.
* Then log in again.
  * you should be asked to authenticate with simplesaml again

### Changing signing / verification and encryption settings

* See `metadata/saml20-sp-remote.php`
* These settings determine **redirect querystring signing** and **encryption**:
  * `'assertion.encryption' => FALSE,`
  * `'redirect.sign' => TRUE,`
  * `'redirect.validate' => TRUE,`
* See `simplesamlphp/docs/simplesamlphp-reference-sp-remote.md` for **assertion and response signing** settings
