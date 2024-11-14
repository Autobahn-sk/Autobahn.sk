#!/bin/bash
php artisan october:migrate &
apache2-foreground
