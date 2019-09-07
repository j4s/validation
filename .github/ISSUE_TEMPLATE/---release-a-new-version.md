---
name: "⚡️ Release a new version"
about: Release a new version
title: "⚡ Release VERSION_NUMBER"
labels: gitflowM
assignees: in4s

---

- [ ] Pin this issue; Pin it to the left
- [ ] Update RSR (optional)
- [ ] git checkout SOURCE_BRANCH_NAME (optional) (create if it does not exist)
- [ ] git pull
- [ ] git checkout -b ReleaseISSUE_NUMBER
- [ ] check PSR by running php-cs-fixer
    - [ ] php-cs-fixer fix .
    - [ ] if files was changed
        - [ ] git add .
        - [ ] git commit -m "php-cs-fixed"
- [ ] Fix the current version number in files:
    - [ ] In README.md
    - [ ] In composer.json
    - [ ] In versions.todo
- [ ] git add . , git commit -m "Release VERSION_NUMBER close #ISSUE_NUMBER"
- [ ] (C*rmr) Create pull request "Release VERSION_NUMBER"
- [ ] (cRM*R) Review pull request, Merge it, swapping title and description, Remove remote branch
- [ ] Remove local branch
- [ ] copy version number, run !!! with appropriate branch !!! https://github.com/in4s/REPO_NAME/releases/new?tag=VERSION_NUMBER
- [ ] copy version number and save in https://github.com/in4s/REPO_NAME/issues/new/?assignees=in4s&labels=test,canProceed,Urgent&title=☑+VERSION_NUMBER+on+&body=-+%5B+%5D+Pin+this+issue%3B+Pin+it+to+the+left%0D%0A-+%5B+%5D+Run+the+test+and+complete+it%0D%0A-+%5B+%5D+Unpin+this+issue+after+closing+it
- [ ] Pin this test issue; Pin it to the left
- [ ] Close milestone with current version name
- [ ] Define next minor(or major) release date (optional), set it on a new milestone
- [ ] Unpin this issue
