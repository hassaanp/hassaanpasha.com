---
title: "Deep Dive Into Object Oriented Programming in JavaScript"
date: 2020-03-07T13:10:01+05:00
draft: true
---

# Introduction

In this post I will try to cover how OOP applies in JavaScript. We are going to explore the prototype chain, see what the `new` keyword really does, and what defining a `class` means in JS. Let's dive in.

![dive-in](https://media.giphy.com/media/JQvqb1awtW9Ve/giphy.gif)

# What is Object Oriented Programming & Why Should I Use It?

There are loads of books/articles/blogs about Object Oriented Programming, so I am not going to reiterate what's already out there or debate its pros and cons.
If you are interested in the paradigm, check out this [article](https://en.wikipedia.org/wiki/Object-oriented_programming) on Wikipedia.

In the simplest terms, an object (in OOP) is a data structure that contains data and methods that can modify that data.

# Sounds Familiar

If you are a JavaScript programmer, then you will feel right at home with the concept of Objects. Creating Objects is no big deal in JS.

```
const book1 = {
    name: "Curtains",
    author: "Agatha Christie",
    genre: "Mystery",
    checkouts: 0,
    incrementCheckouts: function(){
        book1.checkouts++;
    }
}
```

This code block shows a way to create an object. The fields: `name`, `author`, `genre` and `checkouts` represent the data and `incrementCheckouts` is the encapsulated method that modifies the data.

Now, you may be wondering if this is it. Well, yeah. But there are issues with creating objects like this.

Suppose we have a library and each book needs to be tracked, categorized and tagged. If we create simple objects like this, we will be rewriting each object manually. Plus, it wont be memory efficient either.

What can we do to make this DRY?

# DRYing Out Object Creation

![dry](https://media.giphy.com/media/l0K3YG47JubtxL6Ss/giphy.gif)

Time to write a function that generates these book objects.

```
function createBook(name, author, genre, checkouts=0) {
    const book = {};
    book.name = name;
    book.author = author;
    book.genre = genre;
    book.checkouts = checkouts;
    book.incrementCheckouts = function(){
        book.checkouts++;
    }
    return book;
}
```

Now we can call the function `createBook` to generate the book object.

```
const book1 = createBook("Curtains", "Agatha Christie", "Mystery");
```

Awesome! Let's create some more books.

```
const book2 = createBook("The Shinning", "Stephen King", "Thriller");

const book3 = createBook("Inferno", "Dan Brown", "Suspense");

...
```

As we add more books and methods to our book Object, an interesting problem bubbles up. If you notice, each time you create a book using the generator, a new instance of the `incrementCheckouts` method is also created in the memory. If we had several methods like for marking a book as unavailable or checked out, the memory footprint would be unnecessarily large since each book will have copies of the same methods. To solve this, each method should be passed by reference.

# Optimizing for Memory

This is not a hard problem to solve. Here is one way of optimizing the generator:

```
const bookMethods = {
    incrementCheckouts: function(){this.checkouts++},
    //add several other methods
}

function createBook(name, author, genre, checkouts=0) {
    const book = Object.create(bookMethods);
    book.name = name;
    book.author = author;
    book.genre = genre;
    book.checkouts = checkouts;
    return book;
}
```

What is `Object.create()`? First, allow me to introduce you to a hidden property in JavaScript Objects: the `__proto__` (FYI `__` is pronounced dunderscore, i.e double underscore).

![amazed](https://media.giphy.com/media/Fkmgse8OMKn9C/giphy.gif)

When you call `Object.create()`, whatever object you pass in the argument, it is linked to the `__proto__` property of the resulting object.

This allows you to use the methods/properties that are passed as the argument object via the dot notation.

If we create a book using this new generator, we would be able to access the `incrementCheckouts` method, like we used to.

```
const book1 = createBook("Curtains", "Agatha Christie", "Mystery");

book1.incrementCheckouts();

console.log(book1);
```

The result is as we expected.

![huzzah!](https://media.giphy.com/media/xT5LMEp0rYgYc9XKFy/giphy.gif)

But how does that happen?
This is called the prototype chain. The interpreter tries to find the `incrementCheckouts` property on the book1 object. When it is not there, it moves one level up the chain via the `__proto__` and finds it in the bookMethods object.

# Automating With The `new` Keyword

The `new` keyword was introduced to make this easier. But as abstraction increases, the underlying complexity does as well.

With `new`, the code can be rewritten as

```
function CreateBook(name, author, genre, checkouts=0) {
    this.name = name;
    this.author = author;
    this.genre = genre;
    this.checkouts = checkouts;
}

CreateBook.prototype.incrementCheckouts = function(){
        this.checkouts++
    };

const book1 = new CreateBook("Curtains", "Agatha Christie", "Mystery");
```

Here is what `new` does:

1. declares an empty object called `this`.
2. links the `__proto__` property of the empty object to the prototype object of the parent object.
3. returns the `this` object.

The benefit of using this approach is that it is slightly faster to write and it is fairly standard practice in real world code.

A con of using this is if you forget to call the `new` keyword, the resulting object would be `undefined`. To avoid this, most programmers capitalize the first letter of the creator function to relay others that this function has to be called with the `new` keyword.

Also, another problem arises if you decide to create a new function within one of the prototype methods.

```
CreateBook.prototype = function(){
    print(){
        console.log(this.checkouts++)
    }
    this.checkouts++;
    print();
}
```

Something you should keep in mind, `this` refers to the context of the function that calls the method i.e the function on the LHS preceding the dot. Since the print function has no caller, `this` inside it, is instead pointing to the global context.

According the Will Sentance from CodeSmith, this is considered as the biggest 'gotcha' in JavaScript's Object Oriented Programming.

To fix this, you can use the arrow functions which conserve the value of `this` where it is decided by the enclosing lexical scope.

To learn more about the `this` keyword, go to the [MDN](https://developer.mozilla.org/en-US/docs/Web/JavaScript/Reference/Operators/this).

# The `class` keyword

To further abstract OOP in JS, we were provided with the `class` keyword. Again, what happens underneath is unknown to most developers. But since we have built our way sequentially, this should be cake for you to interpret.

Here is how we can rewrite what we did earlier

```
class Book{
    constructor(name, author, genre, checkouts=0){
        this.name = name;
        this.author = author;
        this.genre = genre;
        this.checkouts = checkouts;
    }
    incrementCheckouts = function(){
        this.checkouts++
    }
}

const book1 = new Book("Curtains", "Agatha Christie", "Mystery");
```

The constructor is simply a replacement for the original function:

```
function CreateBook(name, author, genre, checkouts=0){
    this.name = name;
    this.author = author;
    this.genre = genre;
    this.checkouts = checkouts;
}
```

The prototype functions are instead listed as methods inside the class.

And we have already gone over what `new` does.

This means you now understand the inner workings of Object Oriented Programming in JavaScript.

![pat](https://media.giphy.com/media/9Q249Qsl5cfLi/giphy.gif)

Give yourself a pat on the back.

I hope this was useful to you. My purpose was to reinforce my own learning and also help anyone else who wants to wrap their heads around the underlying workings of JavaScript.

Thanks for reading and have a good day.
