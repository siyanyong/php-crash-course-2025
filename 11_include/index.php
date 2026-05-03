<?php include 'header.php' ?>

<main>
    Home Page
</main>

<?php include 'footer.php' ?>

<!-- can use

require 'header.php';

or

require_once __DIR__ . '/header.php';

as well... page will crash if not found

This ensures:

absolute-safe path resolution
prevents double inclusion
clearer error behavior

require missing file → page crashes (fatal error)

include missing file → page continues (warning only)

And for critical layout files like headers/footers, require is often the more correct choice.

-->