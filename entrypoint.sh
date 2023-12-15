#!/bin/bash

nvm install 20
cd project && npm run build
apache2-foreground