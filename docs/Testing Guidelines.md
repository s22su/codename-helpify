An Helpific Overview
==============================

Testing Guidelines
------------------------------

### Unit Tests

#### Fast

One single test should not take more than 1 second to run.

#### Isolated

Each of the tests should have only a single reason to fail. Use only one assertion per test. Also avoid dependencies;
you should be able to predict what tests will break if you make a change in code.

#### Repeatable

If a test fails, and you run it again, it must produce the same result. Avoid non-deterministic testing and use
of databases.

#### Self-verifying

A test fails or passes must be unambiguous; the results should leave no room for human interpretation.

#### Timely

Know what you are going to build before building it.
