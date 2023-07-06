function hello() {
    console.log( arguments.callee.name );
}

hello();
