# Building and Testing Angular

This document describes how to set up your development environment to build and test CS 421.
It also explains the basic mechanics of using `git`.

* [Prerequisite Software](#prerequisite-software)
* [Getting the Sources](#getting-the-sources)

See the [contribution guidelines](https://github.com/sciencejiho/CS421/blob/master/CONTRIBUTING.md) if you'd like to contribute to CS 421.

## Prerequisite Software

Before you can build and test Angular, you must install and configure the following products on your development machine:

* [Git](http://git-scm.com) and/or the **GitHub app** (for [Mac](http://mac.github.com) or [Windows](http://windows.github.com)); [GitHub's Guide to Installing Git](https://help.github.com/articles/set-up-git) is a good source of information.

## Getting the Sources

Fork and clone the CS 421 repository:

1. Login to your GitHub account or create one by following the instructions given [here](https://github.com/signup/free).
2. [Fork](http://help.github.com/forking) the [main CS 421 repository](https://github.com/sciencejiho/CS421).
3. Clone your fork of the CS421 repository and define an `upstream` remote pointing back to the CS421 repository that you forked in the first place.

```shell
# Clone your GitHub repository:
git clone git@github.com:<github username>/CS421.git

# Go to the Angular directory:
cd CS421

# Add the main Angular repository as an upstream remote to your repository:
git remote add upstream https://github.com/sciencejiho/CS421.git
```
