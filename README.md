irccat plugin for Kanboard
==============================

Receive Kanboard notifications on irccat.

Author
------

- Frederic Guillot
- Lisa Marie Maginnis
- License MIT

Requirements
------------

- Kanboard >= 1.0.37
- irccat

Installation
------------

You have the choice between 3 methods:

1. Install the plugin from the Kanboard plugin manager in one click
2. Download the zip file and decompress everything under the directory `plugins/irccat`
3. Clone this repository into the folder `plugins/irccat`

Note: Plugin folder is case-sensitive.

Configuration
-------------

First install and configure irccat if you have not already done so, enable the `generic` http(s) API.

### Receive project notifications to a room

- Go to the project settings then choose **Integrations > irccat**
- Copy and paste the webhook URL from irccat or leave it blank if you want to use the global webhook URL
- Use `Token` to configure the `generic` http(s) secret. Leave blank if your endpoint is not secured with a secret
- Use `Channel` to override the default irccat channels, example: **#some-other-channel**
- Enable irccat in your project notifications **Notifications > irccat**

You can also define the webhook URL globally in the **Application settings > Integrations > irccat**.

### irccat configuration

- Change the config option `EnablePostUsernameOverride` to `true` to have Kanboard as username


## Troubleshooting

- Enable the debug mode
- All connection errors with the irccat API are recorded in the log files `data/debug.log`


## Copyright Attribution

`IRC_Logo_Small.png` by Lilers5 is licensed under CC BY-SA 4.0. To view a copy of this license, visit https://creativecommons.org/licenses/by-sa/4.0/?ref=openverse.
