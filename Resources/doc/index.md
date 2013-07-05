# Getting started with TeckHouse AnalyticsBundle

This bundle is organized in two parts:

- Collection
- Widget

Widgets allow you to see and combine the collection (and its collectionData).

## Collection

So wherever you want you can grab a collection and save data inside it. 

In order to collect data you should write a code like that:

``` php

// Grab the Collection Manager service
$collectionManager = $this->get('teckhouse_analytics.collection_manager');

// Get (find or create) Collection with name in parameter
$collection1 = $collectionManager->getCollection('collection1');

// Create data and save it into the collection
$data1 = New CollectionData();
$data1->setValue(1);
$collection1->addCollectionData($data1);

collectionManager->updateCollection($collection1);

```

## Widget 

Now you have collected data and you have to show it in a Widget. 

To create widget you can use three methods:

- Configuration
- Web Interface 
- In code creation

### Configuration

``` yaml
# app/config/config.yml

teckhouse_analytics:
	widgets:
		your-great-widget-name:
			label: I'm a widget!
			type: counter # you can use "counter" or "leaderboard" 
			collections:
                		collection1: ~
                		collection2: ~
```


### Web Interface

The web interface is very simple to use, you can create, show and delete widgets.

First of all load the routes:

``` yaml
# app/config/routing.yml

teckhouse_analytics:
    resource: "@TeckHouseAnalyticsBundle/Resources/config/routing.yml"
    prefix:   /analytics

```

Now you have the Dashboard that shows a menu with all widget available at path:

```
/analytics/dashboard
```

clicking on the widget name you can show it, the route is like this:

```
/analytics/{widget-name}/show
```

it's possible to delete the same widget with a path like this:

```
/analytics/{widget-name}/delete
```

at the end of the widget list there is the link to create new one

```
/analytics/widget/new
```

### In Code Creation

The example below creates one widget, two collections and inserts inside some data. 

``` php

// The Widget Manager
$widgetManager = $this->get('teckhouse_analytics.widget_manager');

// The collection Manager
$collectionManager = $this->get('teckhouse_analytics.collection_manager');

// Get (find or create) Collection with name in parameter
$collection1 = $collectionManager->getCollection('collection_name_1');
$collection2 = $collectionManager->getCollection('collection_name_2');

// Create data to collect and save it
$data1 = New CollectionData();
$data1->setValue(1);
$collection1->addCollectionData($data1);

$data2 = New CollectionData();
$data2->setValue(1);
$collection2->addCollectionData($data2);

collectionManager->updateCollection($collection1);
collectionManager->updateCollection($collection2);

// Set (find or create) Widget with params: name, label, type, collection array.
$widget = $widgetManager->setWidget('test1', "test", "counter", array("collection_name_1", "collection_name_2"));
        
```

