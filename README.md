# Platform-Widget-Bundle

The Widget bundle provides the developers a way to define widgets in the user interface. 

[![Code Climate](https://codeclimate.com/github/DigitalState/Platform-Widget-Bundle/badges/gpa.svg)](https://codeclimate.com/github/DigitalState/Platform-Widget-Bundle)
[![Test Coverage](https://codeclimate.com/github/DigitalState/Platform-Widget-Bundle/badges/coverage.svg)](https://codeclimate.com/github/DigitalState/Platform-Widget-Bundle/coverage)

## Table of Contents

- [Widget Entity](#widget-entity)
- [Creating a Widget](#creating-a-widget)
- [Context Filter](#context-filter)
- [Todo](#todo)

## Widget Entity

A widget consists of a title and content meant to be displayed in a template in a specific position. Essentially, it allows the developer to customise templates without directly modifying the template files. Widgets are comparable to [ORO Placeholders](https://github.com/orocrm/platform/tree/master/src/Oro/Bundle/UIBundle#introduction-to-placeholders) with two additional features: the capability of adding a title and the context filter.

*Note: Eventually, if possible, we will merge the concept of widgets to ORO Placeholders with our additional features.*

## Creating a Widget

Widgets can be created in any bundle. They are defined the same way as any other services in Symfony using the Service Container. The developer will need to tag the service with the `ds.widget` tag in order for the system to pick it up as a widget. Finally, the developer will need to define a position in a template file, where the widget should be displayed.

**The widget class** `src/Gov/Bundle/BlogBundle/Widget/LatestPostsWidget.php`:

```php
<?php

namespace Gov\Bundle\BlogBundle\Widget;

use Ds\Bundle\WidgetBundle\Widget\Widget;

class LatestPostsWidget extends Widget
{
    public function getTitle()
    {
        return 'Latest Posts';
    }

    public function getContent(array $data = [])
    {
        return '<ul><li><a href="">Post 1</a></li><li><a href="">Post 2</a></li></ul>';
    }
}
```

**The widget service** `src/Acme/Bundle/TestBundle/Resources/config/services.yml`:

```yml
services:
    gov.blog.widget.latest_posts:
        parent: ds.widget.widget.abstract
        class: Gov\Bundle\BlogBundle\Widget\LatestPostsWidget
        tags:
            - { name: ds.widget, position: aside }
```

**The template position**:

```twig
<html>
    <body>
        <aside>
            {% for widget in ds_widgets({ position: 'aside' }) %}
                <h3>{{ widget.title }}</h3>
                {{ widget.content|raw }}
            {% endfor %}
        </aside>
    </body>
</html>
```

## Context Filter

The context filter is an optional parameter allowing the developer to define when a Widget should be rendered.

Let's use a real world example to explain the concept:

The [DigitalState-Platform](https://github.com/DigitalState/Platform) introduces the concept of Government Services through the [DsServiceBundle](https://github.com/DigitalState/Platform/tree/master/src/Ds/Bundle/ServiceBundle). This bundle provides, at its core, the base actions for creating, editing, and deleting Generic Services. The editing action uses of the Widget concept for displaying the core form fields for the Generic Service. 

The [DigitalState-Platform](https://github.com/DigitalState/Platform) also introduces the concept of [BPM](https://en.wikipedia.org/wiki/Business_process_modeling) Services through the [DsServiceBpmBundle](https://github.com/DigitalState/Platform/tree/master/src/Ds/Bundle/ServiceBpmBundle). This bundle grafts itself on top of the [DsServiceBundle](https://github.com/DigitalState/Platform/tree/master/src/Ds/Bundle/ServiceBundle) to provide additional BPM-related functionality for when a business user wishes to create a BPM-based Service. A BPM Service is the same as a Generic Service, with additional fields to map the BPM process definition id and other BPM specific configurations. The DsServiceBpmBundle defines an additional Widget for the additional form fields and [flags the context of the widget as `bpm`](https://github.com/DigitalState/Platform/blob/master/src/Ds/Bundle/ServiceBpmBundle/Resources/config/widgets.yml), meaning this Widget should only be displayed the specific context of BPM.

**The template position with context defined**:

```twig
<html>
    <body>
        <main>
            <form>
                {% for widget in ds_widgets({ position: 'main', context: 'bpm' }) %}
                    <h3>{{ widget.title }}</h3>
                    {{ widget.content|raw }}
                {% endfor %}
            </form>
        </main>
    </body>
</html>
```

## Todo

**Introduce custom twig tag for widget positions.**
  
Example 1: 
```twig
{% position *position_name* with { variable: value } %}
```

Example 2: 
```twig
{% position *position_name* %}
    {{ widget.title }}
    {{ widget.content|raw }}
{% endposition %}
```

**Enable widgets to be defined as template or callbacks, instead of classes.**

