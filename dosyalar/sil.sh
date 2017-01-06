#!/usr/bin/env bash
find /web/download/ -maxdepth 1 -cmin +60 -name "*" -exec /bin/rm -f {} \;
