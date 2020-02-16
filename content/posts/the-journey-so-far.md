---
title: "The Journey So Far"
date: 2020-02-16T12:50:56+05:00
draft: true
---

# Introduction
Hi,

I am Hassaan. I am a software engineer from Islamabad, Pakistan. This is my personal blog/journal. If you are just getting here, read my [first post](https://hassaanpasha.com/posts/my-first-post/) to know why I started writing.

This post is to break down my journey so far in the `software development` realm.

I have a bachelor's degree in Electrical Engineering from [NUST](http://nust.edu.pk/) and I graduated in 2015. But, it was around my 2nd year of college, when I realized I was more interested in writing computer programs. Unfortunately, my university did not allow switching your major, hence I had to look for more creative ways to seep through the cracks towards software development.

# Breaking Into Software Development
My college had a small variety of computer science courses in the Electrical Engineering program, which aided in building a solid foundation. Most of the software that we wrote was using C, C++ and Assembly.

I got a chance to work as an intern for the university webmaster which involved editing xml and static html files (that was not a very useful experience but suffice to say, it made me happy).

I kept on looking for more opportunities and that got me a chance to work with one of my favorite professors who wanted me to build a small application that could grade faculty members' average publication scores.

The project took me a month which was spent in learning C# and parsing data from different databases. It was nothing fancy, but it made me very proud. It was also during this time that I started using Ubuntu Linux as my primary operating system.

Finally, it was the Computer Networks course in the third year of college that got me the break I was so eagerly searching for. The professor was teaching us `Software Defined Networking` as one of the final modules, and that got me thinking of doing my final year project in the domain. I reached out to the professor after one of the classes and told him about a project idea around SDN that I had come up with. He counter-offered and suggested he could get me an internship at [PLUMgrid](https://www.linkedin.com/company/plumgrid/) which was a hot new startup from Silicon Valley at the time with an office in Islamabad. He specified that if I tried hard enough, I could nab a project around SDN with them that had more practical applications. I agreed of course.

# Getting An Internship That Led To My First Job
After a week or so, I got a call from PLUMgrid. They wanted me to come in for an interview. So as soon as I was done with my classes, I booked a taxi and went to their Islamabad office. I had a short interview with one of their engineers and a day later I was asked to join for a 3 month internship.

The following three months, I worked very hard. I had classes in the morning from 9am to 5pm and right after I was done, I drove to the office (I bought a small 70cc motorbike) where I used to spend the next 4-5 hours or even entire nights.

My mentor pushed me to learn things myself and experiment. I was directed to work in the OpenSource community around [Openstack](https://www.openstack.org/) (a cloud management software for private clouds). We found an interesting open issue that was facing several active industrial users. A new version of networking had been launched in Openstack but there was no official migration strategy or tool that could allow existing deployments to move to it with minimal downtime.

I proposed that I would build this migration tool as my Final Year Project and luckily enough, my professor agreed.

It took me two months to build the tool. It was the first time that I had used Node.js and built a functional web application. The application triggered different Python scripts I had written that allowed migrating Virtual Machines using different Openstack APIs. The tool was never submitted as an official migration tool - but I did put it up on my Github with a complete README and everything.

The project did two important things for me:
1. Got me a permanent position at PLUMgrid as a Design Engineer before I graduated.
2. Won me the 2nd best industrial project at my university's Open House 2015.

# The DevOps Life
Before I knew it, I was working as a DevOps Engineer. I was given ownership of writing CI/CD pipelines. These were not your average code testing pipelines - they were full blown deployments of OpenStack distributions, integrations with PLUMgrid's proprietary networking software, followed my running huge testing suites.

(I was married after three months joining PLUMgrid and since this was a new job, I just took a couple weeks off for the entire wedding and honeymoon combined. Note: I should have taken more time off, oh well.)

A year later, I was made part of the infrastructure team that was in charge of maintaining and upgrading old testing pipelines and was given ownership of the testing suite. I pushed myself to take ownership of different projects and I did my best to learn new things as I went along.

While I was writing gigantic bash scripts, doing configuration management with Ansible, writing Docker files, and rewriting tests in Python, I felt a void grow inside of me. My work was beginning to become unfulfilling. I wanted to build things instead of living inside the shell.

In late 2016 PLUMgird was acquired by VMware. We knew that the Islamabad office was facing an eminent end, I decided to pursue my interests and applied in a local startup called [HireNinja](https://www.hireninja.com/) as a Fullstack Developer.

# Learning Web Development
My interview at HireNinja went great. They wanted someone who knew how to use Dockers and had leadership skills - I wanted to learn fullstack web development. I was sent an offer letter the next day and I decided to accept and start next month. A week later I was told that my position was terminated at PLUMgrid.

I had a month in between my jobs which I used to learn Angular, MySQL and PHP Laravel (the tech stack at HireNinja at the time).

I was at HireNinja for 6 months. It was a short tenure but it grew my skills exponentially. These few months were enough to give me a huge confidence boost. Not only did I build web applications, I set up CI/CD processes for all existing applications, taught my peers how to use Dockers to containerize their applications, managed web servers using Apache 2 and Nginx, and I led a small team (a developer and a designer) and worked as a product manager for a photo printing application called Printo.

I was very happy there but a much more exciting venture was presented to me by an acquaintance from my PLUMgrid days and the opportunity was far too important for me to let go. I talked to Asif, the CEO at HireNinja, and explained why the opportunity was important for me. He was reluctant to let me go at first, but finally gave in when he saw how excited I was in pursuing this. I am still in contact with him and I am glad I did not burn any bridge throughout my career.

The new company I joined was called [An10](https://www.linkedin.com/company/an-10/). It was a local company that was formed as a sister company of [Innexiv](http://innexiv.com/). Dr. Affan, the director of engineering at An10, brought me in to help him in building and orchestrating their entire IoT pipeline.

# Juggling DevOps And Web Development
At AN10, I was back to my natural habitat of DevOps . I worked with tools that Netflix uses: the SMACK stack and more to help process and store data coming in from thousands of sensor devices deployed in various remote locations across several countries.

I was also made in charge of the web applications development team where I hired and managed two very awesome developers.

When I was not working on scaling databases or setting up monitoring tools or packaging and deploying microservices - I was building software applications with the applications team. One of the projects I worked on was a Node.js backend that could handle 50,000 event packets per second and use them to set off customized alarms. I used Redis and Node.js clustering to achieve this scale. I also set up Gitlab for our repositories management and built CI/CD pipelines for all our applications. Oh, and I worked with the ELK stack to help set up cool visualizations for a business intelligence tool.

I worked at AN10 for about 18 months. Life there was amazing. I have built strong connections with everyone there and I still have lunch every other week with them.

# Leading A Team
After An10, I joined [Surf](https://www.thesurfnetwork.com/). A company based out of Arizona, USA. I was brought in by a long time friend from my university with whom I had worked part-time in the past as well. He is the acting CTO at Surf and the CEO/founder of [Teamo](https://teamo.io).

I joined as the lead engineer and team lead for the web development team. We built several user facing dashboards, business tools and data analytics pipelines. The software we built was able to provide on demand video content to 3 million+ rides in the USA.

I handled the entire DevOps and had control over all architectural decisions. I used Google Kubernetes Engine and deployed microservices that I wrote in Node.js which were in charge of processing data coming in from all active devices and storing them in to Google BigQuery.

I helped hire 4 developers who I directly managed, and learned from.

# Going To Germany?
After spending a year at Surf, I decided to try applying to Germany. My decision was primarily driven by the fact that most of my professional connections have gone to Europe to pursue exciting new opportunities. The second reason was to get more exposure by working for a larger company.

I applied to 6-7 jobs, I was interviewed by two of them and one of them (an awesome startup called [Doctolib](https://www.doctolib.de/)) decided to hire me and I accepted. 2 months into the visa process, me and my wife found out that her current pregnancy is extremely high risk and that it would not be possible for us to travel together. I did not want to leave her alone. I emailed the talent acquisition manager and decided to be transparent about my situation. I told her that I had to forego the opportunity and support my family.

# Entrepreneurial Pursuits (Now)
A couple of months ago my friend Sohaib, the CEO of Teamo, offered me to partner up with him on his venture as a co-founder and help him scale up his company. I accepted and as of now, I am building the technology behind Teamo and running a software startup.

I am also working remotely with different clients from around the world as a software developer and consultant.

My journey has been full of ups and downs, twists and turns - many details that I don't want to bore you with. I wrote this to remind myself of the progress I have made, and any prospective reader to know that everyone has a different path to tread. You just need to prioritize what you want from life and work on it with consistency.

Thank you for reading and good luck with your journey.