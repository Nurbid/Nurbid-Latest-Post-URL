#!/usr/bin/env bash
set -euo pipefail

if [[ $# -lt 1 || -z "${1// }" ]]; then
  echo "Usage: $0 <version>"
  exit 1
fi

VERSION="$1"

if [[ ! "$VERSION" =~ ^[0-9]+\.[0-9]+\.[0-9]+([.-][0-9A-Za-z.-]+)?$ ]]; then
  echo "Invalid version format: $VERSION"
  echo "Expected semantic versioning, e.g. 1.2.3 or 1.2.3-beta.1"
  exit 1
fi

python3 - "$VERSION" <<'PY'
import re
import sys
from pathlib import Path

version = sys.argv[1]

plugin_file = Path("nurbid-latest-post-url.php")
plugin_text = plugin_file.read_text(encoding="utf-8")
plugin_text = re.sub(r"^(Version:\s+).*$", rf"\g<1>{version}", plugin_text, count=1, flags=re.MULTILINE)
plugin_text = re.sub(
    r"(define\(\s*'NURBID_LPU_VERSION',\s*')[^']*('\s*\);)",
    rf"\g<1>{version}\g<2>",
    plugin_text,
    count=1,
)
plugin_file.write_text(plugin_text, encoding="utf-8")
PY

echo "Synced version to $VERSION in nurbid-latest-post-url.php"
