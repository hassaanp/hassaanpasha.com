---
title: 'Breaking down the JavaScript execution thread (Part 1)'
date: 2021/4/2
description: How does JS code run in the browser and Node.js runtime
tag: JavaScript
author: Hassaan Pasha
---

# Breaking down the JavaScript execution thread (Part 1)

Understanding how your JavaScript code runs on the browser or in the NodeJS runtime, can greatly impact the way you design your software. Today I will attempt to break down the entire execution thread to help create a mental picture of why our code runs the way it does.

The JS execution thread can be divided into 3 major components:
1. Execution context
2. Call stack
3. Memory

There are 2 other features that I will cover in Part 2 of this entry to complete the model. These are:
4. The Event Loop
5. Callback queue


# Execution Context
Before JavaScript code runs, the browser or the Node.js runtime creates a global execution context. Sounds complicated, so let us try to simplify. You can think of the execution context as an environment or a box (I personally like to imagine it as a container) which will have an associated memory to store data and it will utilize computational resources to run the code line by line. The global execution context terminates once the program exits. The memory assigned to the global context can be thought of as "scoped" to it. In other words, the global memory will be available to everything that runs inside the global execution context and will be deleted when the program exits.

When a function executes, it creates its **own** execution context. This means that the function also is assigned its own _scoped_ memory. However, this local memory can only be accessed by the code that runs inside the function's context. When the function exits, its execution context and local memory is destroyed.

_Side note: there is a way to persist the local memory after its execution context is destroyed. This has to do with something called closure. I will not be going into closure today, but there are many great articles out there that explain what closure is._

# Memory
We have already talked about memory in the section above. We use the memory to store all our variables, objects and function definitions.

For example, lets go over this piece of code line-by-line:
```
let a = 1;
const b = 2;
function c (){
    return a + b;
}
```
- line 1: create an identifier `a` in the memory and assign it a number value 1
- line 2: create an identifier `b` in the memory and assign it a number value 2
- line 3: create an identifier `c` in the memory and assign it a function definition

# Call stack
The word call stack gives enough clues for us to get an idea of what it must be. It is simply a stack data structure which can be visualized as a stack of books. To access the book at the bottom of the stack, you have to remove the books on top. Similarly, new books will be added on top of the stack.

To understand how the call stack works, lets use a quick example:
```
function hello () {
    print('hello world');
}

function print(str){
    console.log(str);
}

hello();
```

When this JavaScript program runs, the default function on the stack is `global()`. 

```
------------
| global() | <- top of the stack
------------
```
As soon as the function `hello` is invoked using the parantheses `()` operator, that function is inserted on to the stack. As discussed in the section above, invoking the function will create its execution context. 
Right now, our call stack looks like this:

```
-----------
| hello() | <- top of the stack
-----------
|global() |
-----------
```
Inside the `hello` function, we notice there is an invokation to another function `print()`. This pushes the `print` function on top of the call stack. 

```
-----------
| print() | <- top of the stack
-----------
| hello() |
-----------
|global() |
-----------
```

When the print function terminates, the function is removed from the top of the call stack.

```
-----------
| print() | x removed
-----------
| hello() | <- top of the stack
-----------
|global() |
-----------
```
The same happens when `hello` function stops running. At the end, we are back to `global()`.

```
------------
| global() | <- top of the stack
------------
```

# Summary
Now that we have insight into the three components, we can break down a simple JS code block, line-by-line and take a look at the execution context, memory and callstack.

```
let num1 = 1;
let num2 = 2;

function add (a, b){
    return a + b;
}

function average (a, b) {
    const sum = add (a, b);
    return sum/2;
}

let result = average(num1, num2);
```

<iframe width="560" height="315" src="https://www.youtube.com/embed/NvsCR0L0Z1E" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>