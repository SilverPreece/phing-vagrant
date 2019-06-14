# Phing Tasks for Vagrant

[![Build Status](https://travis-ci.org/GregJPreece/phing-vagrant.svg?branch=master)](https://travis-ci.org/GregJPreece/phing-vagrant)
[![Coverage Status](https://coveralls.io/repos/github/GregJPreece/phing-vagrant/badge.svg)](https://coveralls.io/github/GregJPreece/phing-vagrant)

This Phing extension provides a wrapper for the Vagrant binary, so that Vagrant 
virtual machines can be easily controlled from within Phing build targets. While
this task library is not designed to be 100% feature complete with the Vagrant
command line, it should provide what is required during Phing builds.

## Supported Versions

| Software | Version |
| --- | --- |
| PHP | 7.1+ |
| Vagrant | TBD* |

* I have been submitting patches to Vagrant's machine-readable mode,
to get all of the Phing tasks here working correctly. As a result, 
the minimum version for this extension will likely be 2.2.5, but this
remains to be seen.

# Helping with Development

phing-vagrant's codebase requires no prep to develop against other than installing
its Composer dependencies, along with 
[Vagrant](https://www.vagrantup.com/downloads.html) and 
[a supported Vagrant provider](https://www.vagrantup.com/docs/providers/).

```
git clone https://github.com/GregJPreece/phing-vagrant
cd phing-vagrant
composer install
```

As so many combinations of operating system, Vagrant package and provider package
exist, installation of Vagrant and its VM provider are left as an exercise
for the reader. [Virtualbox](https://www.virtualbox.org/wiki/Downloads) is a common 
FOSS provider easily obtainable on most platforms, and as such is the default 
provider for Vagrant.

Being popular FOSS projects, both Vagrant and Virtualbox are likely to be available 
via your operating system's package manager, if it has one.

## Running tests

phing-vagrant uses Codeception (which in turn uses PHPUnit) to provide automated
testing. Note that running these tests does not require Vagrant or a provider
to be installed. To run tests, ensure you have installed the project's Composer
dependencies, and then:

```
vendor/bin/codecept run
```