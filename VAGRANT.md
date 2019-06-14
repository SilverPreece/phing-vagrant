# Issues with Vagrant's --machine-readable mode

This document is a quick-reference for issues encountered when using the
`--machine-readable` flag with the `vagrant` binary. At some future point,
if time and skills allow, I may contribute fixes to Vagrant itself to clean
up the output and fix these edge cases. This file exists during initial development
of the project for ease of reference.

## Getting local Vagrant version

There are two ways to read the locally installed Vagrant version:

`vagrant --version`

`vagrant version`

The latter method supports the `--machine-readable` flag, but also makes a network
request to the Hashicorp servers to check the latest version available. This
introduces some unnecessary lag, as we don't really care what the next version of
Vagrant is.

However, the former method of seeking the version doesn't support the 
`--machine-readable` flag, so its output can't be parsed in regular fashion - I'd
have to bypass regular execution and regex the output.

It would be nice if either the first method could support machine readable output,
or the second method could gain a flag to suppress update checks.

## Destroying the box

When attempting to destroy a box with the `--machine-readable` flag, the following
error occurs. It does not occur when the `--force` flag is also added. This is
because `vagrant destroy` will normally prompt the user to confirm VM destruction,
which the machine-readable output cannot handle. This isn't *really* a bug, but
perhaps the `--machine-readable` flag should imply `--force`?

`1556436418,,error-exit,Vagrant::Errors::UIExpectsTTY,Vagrant is attempting to 
interface with the UI in a way that requires\na TTY. Most actions in Vagrant that 
require a TTY have configuration\nswitches to disable this requirement. Please do 
that or run Vagrant\nwith TTY.`

## Installing plugins with multiple version constraints

According to the 
[Vagrant docs](https://www.vagrantup.com/docs/cli/plugin.html#plugin-version-version)
it is possible to specify upper and lower bounds for a plugin's version. However,
whenever I do this using the format shown in the docs, an error occurs. A single
upper or lower bound succeeds, and a specific version succeeds. This appears to be
a bug in Vagrant or its Ruby dependencies, so I have opened ticket 
[10877](https://github.com/hashicorp/vagrant/issues/10877).

## Some commands have no machine-readable output

Within Vagrant, different output functions are used for "UI" output, and  machine-
readable output. It seems that not all functions currently have machine-readable
output specified in their plugin files. I have begun submitting patches to Vagrant
to correct this, though this may then mean that this extension cannot operate with
existing Vagrant versions.

## Unparseable output when running SSH commands

When passing an SSH command to the guest, the stderr response is dropped directly
into the machine-readable output without any formatting, which breaks the hell out
of an attempt to parse it. Need to add special-case capture for these when parsing
responses.