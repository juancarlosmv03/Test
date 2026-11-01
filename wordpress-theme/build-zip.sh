#!/usr/bin/env bash
# Build quesada-fitness.zip, ready for Appearance → Themes → Upload Theme.
set -euo pipefail
cd "$(dirname "$0")"
rm -f quesada-fitness.zip
zip -rq quesada-fitness.zip quesada-fitness -x '*.DS_Store'
echo "Created $(pwd)/quesada-fitness.zip"
