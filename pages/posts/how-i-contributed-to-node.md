---
title: 'I Contributed to Node.js'
date: 2020-03-25T17:06:53+05:00
description: How did I manage to help out the Node.js community
tag: node, opensource
author: Hassaan Pasha
---

Hi folks. This is an update to the Opensource journey I started at the beginning of this year.

![code](https://media.giphy.com/media/ZvLUtG6BZkBi0/giphy.gif)

Around the first week of March, I came across a tweet by a seasoned Node.js contributor who I follow. It referenced an issue that was up for grabs. A new version of OpenSSL was to be released on March 17th, and since Node uses OpenSSL as a core dependency, the team wanted to update accordingly.

You can call it a stroke of luck - I found myself to be the proverbial early bird and I opted to take up the task.

I have been using Node.js for the last 5 years now and I have built extensive tools with it. Being offered a chance to push code to its repository was exciting and scary at the same time.

I marked my calendar and waited for the release of OpenSSL 1.1.1e.

# Doing a Test Run

![test run](https://media.giphy.com/media/nDUYW2I36b2i47d0xp/giphy.gif)

Since the release was a week into the future, I decided to build the Node.js repository on my laptop and do a test run by reconfiguring the available OpenSSL library.

The contributing docs are straight forward, especially if you are familiar with various build tools like `make`.

I thought this was going to be cake, and so I waited.

# Scrambling to Build the New Version

It was around 6PM on March 17th that I was able to pull in the latest OpenSSL tar file. My test run had me prepared. An update guide was available that laid down how to go about this. I followed it to the T.

Lo, and behold! The build failed.
![failed](https://media.giphy.com/media/13HgwGsXF0aiGY/giphy.gif)

It's been a while since I looked at C++, so I was a little uncomfortable with how I could proceed. There was a stacktrace available, but it was overwhelming, especially, as I had not been expecting to run into trouble. I sent updates to the original issue and mustered the courage to begin debugging.

It took me about an hour to figure out the issue. The Makefiles in Node's build steps were expecting a certain directory structure in the OpenSSL files. This expectation was causing the build to fail as the directory structure had been modified.

![I have seen the light](https://media.giphy.com/media/nBQefMWjqdLc4/giphy.gif)

Finally, the fog was clearing up and with another hour or two of trial and error, I was able to fix the Makefiles, and run the build successfully.

# Testing It Out

As any real opensource tool, you have to run a testing suite to ensure no tests fail before you can push your code.

And as luck would have it, there were two tests that were breaking. I decided to push the PR, and fix them the next day.

The author of the issue looked over my submission during the time and left helpful remarks. His main cause of concern was that my local repository was several commits behind the upstream repository.

# Almost There

The morning I woke up with a fresh mind, ready to wrap this up. A goodnight's sleep is invaluable to your processing power. It only took me 15 minutes to fix one of the tests and another 15 minutes to resolve the rebase issue.

![coding spree](https://media.giphy.com/media/LmNwrBhejkK9EFP504/giphy.gif)

Believing everything was ready to go, I pushed the final changes and waited for the CI pipelines to quash my hopes. Unsurprisingly, the pipelines showed that I had left some linting problems. Rookie mistake!

The rest of the story becomes uninteresting here and I will save you the trouble of reading through it.

Long story short, my pull request was finally merge ready by the 19th of March. The actual merge happened on the 23rd.

![celebration](https://media.giphy.com/media/l0MYt5jPR6QX5pnqM/giphy.gif)

# What now?

I am now ready to add more contributions to the Node.js repository. But before I can do that, I have to build more understanding of the underlying code base. I am working on that these days and I hope that would give me more confidence to take up more challenges.

Stick around for the next update from my opensource journey.

Thanks for reading.
![adios](https://media.giphy.com/media/ZBVhKIDgts1eHYdT7u/giphy.gif)
