---
title: "Deep Copy Implementation in JavaScript"
date: 2020-03-04T13:20:21+05:00
draft: false
---

# Introduction

I was recently asked to implement a deep copy in JavaScript from scratch. If you are familiar with [Lodash](https://lodash.com/) then you might have used the [`cloneDeep`](https://lodash.com/docs/4.17.15#cloneDeep) method.

In this post we'll explore different type of copies and I'll explain how I hacked up a crude form of the deep copy.

# Shallow Copy vs Deep Copy

![deep-copy](https://media.giphy.com/media/iFkHQLzYA09Zm/giphy.gif)

Imaging you have an object called userTemplate with a nested object called addressTemplate:

```
var addressTemplate = {
    street: 0,
    house: 0,
    block: "",
    city: "",
    country: ""
}

var userTemplate = {
    name: "",
    age: 0,
    address: addressTemplate
}
```

Now, let's say you want to copy this userTemplate object and create a couple of users, how would you do that?

One approach would be through the spread operator in ES6:

```
var firstUser = {...userTemplate}
var secondUser = {...userTemplate}
```

Now let's add some information to the user objects.

```
firstUser.name = "Hassaan Pasha";
firstUser.address.city = Islamabad;
secondUser.name = "Professor X";
secondUser.address.city = "New York";
```

Now we'll print out the two users using `console.log(firstUser, secondUser)`

The result is

```
{
  name: "Hassaan Pasha",
  age: 0,
  address: { street: 0, house: 0, block: "", city: "New York", country: "" }
}
{
  name: "Professor X",
  age: 0,
  address: { street: 0, house: 0, block: "", city: "New York", country: "" }
}

```

Oops, looks like I moved to New York 😲
So what happened?

It comes down to how JavaScript stores objects in memory. Unlike [primitive types](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Data_structures), objects are passed by reference. This includes `Array`, `Function` and `Object` data structures. So, when we first declared the `userTemplate`, we stored the reference to the `addressTemplate` in the address property.

This is shallow copying. And, as you guessed, a deep copy is when all instances of the references are duplicated into unique memory locations, avoiding the problem we just saw.

# An Implementation of the Deep Clone

Before I proceed, I would like to make it clear that this is a hacked up solution that I glued together in 15 minutes. I wrote some unit tests to make sure it worked. Currently, I have not added support for Arrays of nested Objects or Functions.

I thought of using the simplest approach that I could use. We know that the spread operator gives us a shallow copy. All that needed to be done was to identify if the `typeof` a value in the parent object was `object` and that it was not an `instanceof` an `Array`, and then call the function recursively on it to return its duplicate. In the case, a key-value was an `instanceof` array, we could simply call the spread operator to create a duplicate of the original. For all other types, the value was simply assigned.

That sounds complicated, but it is really not. The code might make more sense:

```
/**
 * deepClone utility
 * This utility function will be able to deep clone nested objects.
 * Support for deep copying array as the parameter not yet provided
 * @param {object} object
 *
 */
const deepClone = object => {
  try {
    ... //some validation on input types
    const clonedObject = {};
    Object.keys(object).forEach(key => {
      if (typeof object[key] === "object" && !(object[key] instanceof Array)) {
        clonedObject[key] = deepClone(object[key]);
      } else if (object[key] instanceof Array) {
        clonedObject[key] = [...object[key]];
      } else {
        clonedObject[key] = object[key];
      }
    });
    return clonedObject;
  } catch (error) {
    throw new Error(error);
  }
};

module.exports = deepClone;
```

![confused?](https://media.giphy.com/media/xhN4C2vEuapCo/giphy.gif)

Sorry to throw that all on you. Let me run through the important parts of the code.

I used the `Object.keys(object)` method to get all the keys of the passed object and then called `forEach` to parse through the entire object.

Each key-value pair is examined. To ensure a value is a JSON object (not an array), I used the following check: `typeof object[key] === "object" && !(object[key] instanceof Array)`. Now, when I am sure this is an object, I call the `deepClone` and pass in the object to get a new duplicate.

The next check is for values that are an `Array`. For all arrays, I simply call the spread operator to generate a shallow copy. This is good enough for most instances. If you have an Array of nested Objects, God help you.

The last block is for the rest of the `primitive` types. It simply assigns its value to the key.

I hope this post was useful to you. Let me know what you think in the comment section below.

Thanks for reading and have a great day!
