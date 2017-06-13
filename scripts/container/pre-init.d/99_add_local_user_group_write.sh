#!/usr/bin/env sh
if [ "$DEPLOY_ENV" == "local" ]; then
  chgrp -R "${LOCAL_USER_GROUP}" "${DRUPAL_ROOT}"
  chmod g+w -R "${DRUPAL_ROOT}"
fi
