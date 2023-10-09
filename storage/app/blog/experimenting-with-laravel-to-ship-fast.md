---
title: Experimenting with Laravel to Ship Fast
date: 2023-10-07 05:59:30
description: My takeaways on moving from a pure JS stack to a hybrid stack using Laravel and React w/ Inertia
slug: experimenting-with-laravel-to-ship-fast
tag: Indiehacking
author: Hassaan Pasha
---

I am always tinkering around with different tech, sometimes that is influenced by the pulse of the tech community, and other times it is curiosity driven by personal painpoints and struggles.

While most of my time is preoccupied with growing [Teamo](https://teamo.io), I spend the rest of the time available to me to explore different ideas and build proof of concepts or MVPs. The last decade, I went from starting my career in DevOps to building highly scalable applications, my primary tool of choice became JavaScipt.

The main idiosyncracy of the JS ecosystem is its propensity to evolve at a very rapid rate. This is partly driven by the fact that JS can be run on both the client and server side which has led to a significant portion of the tech community focus their attention to it and build applications with it. This primarily has upsides, but there are some quality of life concerns with being a JS developer.

## Framework Fatigue

JavaScript ecosystem has soooo many frameworks that is is ridiculous. Each have their own way of building apps and each add their own flavor of syntax to write UI code. Everyone claims to be the best, and most of them are unopinionated.

As a developer who has worked in the JS stack for around 8 years now, I have tried and worked with almost every known technology that gained popularity during this time. Mostly, because I am a curious guy. To give you an idea, I have built this website from the ground up, 5 times already with different stacks, just to try them out.

While all these frameworks and runtimes have been great at demonstrating the flexibility and adaptability of JS and TS, it causes a great strain on the everyday JS dev who has to constantly switch gears to stay relevant in he industry. One can argue that as long as you have your fundamentals straight, you won't have to struggle too much. However, I don't think that is necessarily true.

There have been great opinionated fullstack frameworks like NextJS but I feel the DX with NextJS has gone down the drain in the pursuit of adding more features (Also a lock-in with Vercel???!!). Now we have Sveltekit and NuxtJS as possible alternatives to NextJS. But that is the problem. There is just too much to choose from and there are always newer, better frameworks just around the corner.

I guess what I am trying to say is that I am tired of keeping up to speed with the pace of developments within the JS ecosystem. Keep in mind, these are my personal opinions and they are likely not going to reflect the pulse of the community in general.

## Finding the right tool for my use-case

Like I mentioned before, my goal is to build MVPs and PoCs. I want to work with something that takes the pressure off of me on what toolchain to use. For me, the important thing is DX and pace of development.

For this purpose I came across the following options:

1. Firebase w/ JS
2. Rails
3. Laravel

Using Firebase has been a great experience overall. The main challenge here was deciding the tool-chain and the DX of debugging. It is hard to debug Firebase apps and timeconsuming to bootstrap a full-stack project. I have to configure it differently each time which adds an extra overhead that I don't want.

Rails and Laravel have been the industry standard for rapid development and building applications quickly. Each has a very opinionated stack that makes you forget about what tool-chain to use. I therefore invested time in both stacks with the goal of finding my weapon of choice.

I really enjoyed Ruby but for some reason, the Rails framework just did not click for me. PHP was equally good and easy to pick up. However, it was Laravel that really piqued my curiousity. It is simply elegant. Any use case that I have thought of so far, Laravel has thought of it and built tools within it to tackle them.

I played around with it for a couple days and the difference was clear. I was able to build a fully functioning, non-trivial application in less than a day. All with schedulers, console commands, REST endpoints, workers and a great ecosystem of libraries. The documentation is amazing and their new way to bootstrap apps using Breeze is so good!

Right now, I am using Laravel Breeze to configure applications with Laravel and InertiaJS. Everything gets setup with a single command and I can churn out a complete web app in record time.

## TL;DR

-   Experienced 'Framework Fatigue' from the rapid evolution and multitude of frameworks in the JS ecosystem.
-   Explored different tech stacks to find a more efficient way to build MVPs and PoCs
-   Evaluated Firebase, Rails, and Laravel; found Laravel to be the most elegant and efficient for rapid development.
-   Appreciated Laravel's opinionated stack, which eased the decision on tool-chain use, and its well-thought-out solutions for various use cases.
-   Utilized Laravel Breeze and InertiaJS to bootstrap apps quickly; crafted a fully functional app in less than a day, highlighting a significant improvement in the pace of development.
