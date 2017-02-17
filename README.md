# Platform-Locale-Bundle

The Locale bundle extends the OroLocaleBundle and provides additional core locale functionality. 

[![Code Climate](https://codeclimate.com/github/DigitalState/Platform-Locale-Bundle/badges/gpa.svg)](https://codeclimate.com/github/DigitalState/Platform-Locale-Bundle)
[![Test Coverage](https://codeclimate.com/github/DigitalState/Platform-Locale-Bundle/badges/coverage.svg)](https://codeclimate.com/github/DigitalState/Platform-Locale-Bundle/coverage)

## Table of Contents

- [Twig Extensions](#migration-extensions)
- [Todo](#todo)

## Twig Extensions

This bundle provides a convenient twig extension to translate localised entity attributes based on current request locale.

**Example**:

```twig
<html>
    <body>
        <h1>
            {{ service.titles|localized_value }}
        </h1>
    </body>
</html>
```

## Todo

