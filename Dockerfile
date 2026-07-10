FROM ghcr.io/unb-libraries/drupal:10.x-1.x-unblib

# Install additional OS packages.
ENV ADDITIONAL_OS_PACKAGES="postfix php-ldap php-zip php81-pecl-redis php81-xmlreader"
ENV DRUPAL_SITE_ID="datasets"
ENV DRUPAL_SITE_URI="datasets.lib.unb.ca"
ENV DRUPAL_SITE_UUID="977e6269-f41c-44b6-b5bd-d0c1bd5f9053"

# Build application.
COPY ./build/ /build/
RUN ${RSYNC_MOVE} /build/scripts/container/ /scripts/ && \
  /scripts/addOsPackages.sh && \
  /scripts/initOpenLdap.sh && \
  /scripts/setupStandardConf.sh && \
  /scripts/build.sh

# Deploy configuration.
COPY ./configuration ${DRUPAL_CONFIGURATION_DIR}
RUN /scripts/pre-init.d/72_secure_config_sync_dir.sh

# Deploy custom modules, themes.
COPY ./custom/themes ${DRUPAL_ROOT}/themes/custom
COPY ./custom/modules ${DRUPAL_ROOT}/modules/custom

# Container metadata.
LABEL ca.unb.lib.generator="drupal9" \
  org.opencontainers.image.title="datasets.lib.unb.ca" \
  org.opencontainers.image.description="datasets.lib.unb.ca provide access to various UNB Libraries Archives Datasets." \
  org.opencontainers.image.vendor="University of New Brunswick Libraries" \
  org.opencontainers.image.authors="UNB Libraries <libsupport@unb.ca>" \
  org.opencontainers.image.url="https://datasets.lib.unb.ca" \
  org.opencontainers.image.source="https://github.com/unb-libraries/datasets.lib.unb.ca" \
  org.opencontainers.image.version="$VERSION" \
  org.opencontainers.image.revision="$VCS_REF" \
  org.opencontainers.image.created="$BUILD_DATE"
