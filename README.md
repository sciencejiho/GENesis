# GENesis

![Test](https://github.com/sciencejiho/GENesis/workflows/Test/badge.svg)&nbsp;

Choosing a course is what every single student of UIUC does in their school curriculum. However, it seems we lack a convenient tool to have an overview of all general educations courses with various attributes at the same time (students' rating, online or offline, past average GPA, etc) This project will combine all those data and help students make their own choice with more information.

## Table of contents

* [What's included](#tree)
* [Contributing to GENesis](#contribute)
* [Git Workflow](#workflow)

## <a name="tree"></a> What's included

```text
GENesis/
└── src/
    ├── best.php                // best courses from each department            
    ├── coursesearch.php        // course search in the main page
    ├── courserec.php           // recommend courses based on user's NetID (Advanced Function)
    ├── create.php
    ├── delete.php
    └── popular.php             // 10 most popular courses
```

## <a name="contribute"></a> Contributing to GENesis
Want to file a bug, contribute some code, or improve documentation? Excellent! Read up on our guidelines for [contributing][contributing].

## <a name="workflow"></a> Git Workflow
The core idea behind the Feature Branch Workflow is that all feature development should take place in a dedicated branch instead of the master branch. This encapsulation makes it easy for multiple developers to work on a particular feature without disturbing the main codebase. It also means the master branch will never contain broken code, which is a huge advantage for continuous integration environments.

#### release
This branch contains the machine problems from the semester, as well as any other code examples staff members want to send to the students.

### Main Branches
* master
* develop

#### master
This is the main branch where the source code of HEAD always reflects a production-ready state. I consider this branch to be the main branch where the source code of HEAD always reflects a state with the latest delivered development changes for the next release. Some would call this the “integration branch”.

#### develop
This branch is the branch where all the development takes place. When the source code in the develop branch reaches a stable point and is ready to be released, all of the changes should be merged back into master somehow and then tagged with a release number. How this is done in detail will be discussed further on.

### Feature Branches
* feature
* hotfix

#### feature
Feature branches (or sometimes called topic branches) are used to develop new features for the upcoming or a distant future release. When starting development of a feature, the target release in which this feature will be incorporated may well be unknown at that point. The essence of a feature branch is that it exists as long as the feature is in development, but will eventually be merged back into develop (to definitely add the new feature to the upcoming release) or discarded (in case of a disappointing experiment).

Feature branches typically exist in developer repos only, not in origin.

#### hotfix
Hotfix branches are very much like release branches in that they are also meant to prepare for a new production release, albeit unplanned. They arise from the necessity to act immediately upon an undesired state of a live production version. When a critical bug in a production version must be resolved immediately, a hotfix branch may be branched off from the corresponding tag on the master branch that marks the production version.

The essence is that work of team members (on the develop branch) can continue, while another person is preparing a quick production fix.

----------

[contributing]: https://github.com/sciencejiho/GENesis/blob/master/CONTRIBUTING.md
