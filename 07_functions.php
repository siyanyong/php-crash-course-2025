<?php

// Simple Function
// function sayHello() {
//     echo "Hello, World!";
// }
// sayHello(); // Output: Hello, World!

// With Parameter
// function greet($name) {
//     echo "Hello, $name!";
// }
// greet("Alice"); // Output: Hello, Alice!
// greet("Bob");   // Output: Hello, Bob!

// Parameter default value
// function greet($name = 'Guest') {
//     echo "Hello, $name!";
// }
// greet();        // Output: Hello, Guest!
// greet("Alice"); // Output: Hello, Alice!

// Return from function
// use default
function multiply(int $a, $b = 3) {
    return $a * $b;
}
// use named arguments
$result = multiply(a:4);
echo $result; // Output: Result: 12