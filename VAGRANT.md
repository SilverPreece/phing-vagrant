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
error occurs. It does not occur when the `--force` flag is also added.

`1556436418,,error-exit,Vagrant::Errors::UIExpectsTTY,Vagrant is attempting to 
interface with the UI in a way that requires\na TTY. Most actions in Vagrant that 
require a TTY have configuration\nswitches to disable this requirement. Please do 
that or run Vagrant\nwith TTY.`