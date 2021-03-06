# Chandika

Chandika provides information on the resources being used by our services, allows new resources to be created and maintained, and is intended to be used with [Raktabija](https://github.com/18F/raktabija) to destroy unused resources.

For more on the motivation behind Chandika, read the blog post [Patterns for managing multi-tenant cloud environments](https://18f.gsa.gov/2016/08/10/patterns-for-managing-multi-tenant-cloud-environments/)

## Developing and testing locally

Chandika uses [Scotch Box](https://box.scotch.io/) as a testing environment. Check out the code, run `vagrant up`, and hit `192.168.33.20`.

## Deploying to cloud.gov

Once you've [set up your credentials on cloud.gov](https://docs.cloud.gov/getting-started/setup/) and [associated a mysql database](https://docs.cloud.gov/apps/managed-services/), simply type the following

```
cd public
cf set-env [appname] CHANDIKA_OAUTH OFF # unless you want OAuth enabled, see section below
cf push [appname]
```

## OAuth integration

Chandika integrates with GitHub's OAuth. If you'd like to enable OAuth integration, you need to set two environment variables:

```
CHANDIKA_OAUTH_CLIENT_ID # this is the Client ID you get when creating an OAuth application on GitHub
CHANDIKA_OAUTH_CLIENT_SECRET # this is the Client Secret you get when creating an OAuth application on GitHub
```

If you're deploying to cloud.gov, you can use the following commands to set these environment variables (remember to unset `CHANDIKA_OAUTH` with `cf unset-env [appname] CHANDIKA_OAUTH`)

```
cf set-env [appname] CHANDIKA_OAUTH_CLIENT_ID <client-id>
cf set-env [appname] CHANDIKA_OAUTH_CLIENT_SECRET <client-secret>
```

If you're deploying locally with Vagrant, you can set these variables in the Vagrantfile (see the existing entry for `CHANDIKA_OAUTH` and then type `vagrant provision`.

You can also limit who can log into Chandika. Chandika asks GitHub to which organization the user logging in belongs. To limit access only to GitHub users in a particular organization (or set of organizations), set the environment variable `CHANDIKA_OAUTH_ORGS` to a comma-separated list of acceptable organizations.

## The origin of the name Chandika

The demon Raktabija had a superpower that meant that when a drop of his blood hit the ground, a new duplicate Raktabija would be created. Thus when the goddess Kali fought him, every time she wounded him, multiple new Raktabijas would be created. The goddess Chandika helped Kali kill all the clone Raktabijas and eventually killed Raktabija himself. The Chandika app is designed to help you kill the profusion of unused virtual resources that accumulate in a typical cloud environment.

# Public domain

This project is in the worldwide [public domain](LICENSE.md). As stated in [CONTRIBUTING](CONTRIBUTING.md):

> This project is in the public domain within the United States, and copyright and related rights in the work worldwide are waived through the [CC0 1.0 Universal public domain dedication](https://creativecommons.org/publicdomain/zero/1.0/).

> All contributions to this project will be released under the CC0 dedication. By submitting a pull request, you are agreeing to comply with this waiver of copyright interest.
