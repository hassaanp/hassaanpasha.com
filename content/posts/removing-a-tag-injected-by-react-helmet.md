---
title: "Removing a Tag Injected by React Helmet"
date: 2020-02-27T11:59:18+05:00
draft: false
---

# But Why?

![but whyyyy](https://media.giphy.com/media/X4YqmJEl6wJoY/giphy.gif)

I recently had a case where I needed to add a `meta` tag to the head in a React Application to prevent a specific path of it from being indexed by Google. This tag is only restricted to a subset of the application, therefore, it needed to be removed from all other pages. Seems simple enough, but the application is server-side-rendered and uses React-Helmet. This causes any changes made in the head to persist unless overwritten by its child component. I had to figure out a way to remove the injected header.

```
React-Helmet manages all of your changes to the document head.
```

Using the DOM API's `document.querySelector` followed by `.remove` methods served my purpose. In this post I will show how you can do this for whatever reason.

# How to add a `meta` tag to the head using React-Helmet

This is quite straight-forward. The documentation for the library is not particularly great but there isn't much to it anyway.

Here is how you add a tag to the Head:

```
<Helmet>
    <meta name="googlebot" content="noindex" />
</Helmet>
```

Easy peezy. You can learn more about the library on its [Github](https://github.com/nfl/react-helmet).

# Remove Injected Tag Using `UseEffect` Hook

```
useEffect(){
    // Returns the cleanup function
    return ()=>{
        const metaTag = document.querySelector(`meta[name="googlebot"]`);
        if (metaTag) {
            metaTag.remove();
        }
    }
}
```

# Remove Injected Tag Using `ComponentWillUnmount` Lifecycle Method

```
componentWillUnmount() {
    const metaTag = document.querySelector(`meta[name="googlebot"]`);
    if (metaTag) {
        metaTag.remove();
    }
}
```

# Final Thoughts

I believe there should be a cleanup function in the react-helmet library. Maybe there is, I could not find it in the docs though. If you have more knowledge about this library feel free to educate me and everyone who comes across this post in the comment section below.

Thanks for reading.
