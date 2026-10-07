#!/usr/bin/env bash
set -euo pipefail

cd "$(dirname "$0")/.."

export NVM_DIR="${NVM_DIR:-$HOME/.nvm}"
# shellcheck disable=SC1091
source "$NVM_DIR/nvm.sh"
nvm use

PYENV_PY2="$HOME/.pyenv/versions/2.7.18/bin"
if [ ! -x "$PYENV_PY2/python" ]; then
  echo "Python 2.7.18 (pyenv) not found at $PYENV_PY2" >&2
  echo "Install it with: brew install pyenv && pyenv install 2.7.18" >&2
  exit 1
fi

export PATH="$PYENV_PY2:$PATH"

npm install "$@"
