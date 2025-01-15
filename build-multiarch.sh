#!/bin/bash

# Install QEMU emulation
docker run --rm --privileged multiarch/qemu-user-static --reset -p yes

# Create and use a new builder instance
docker buildx create --name multiarch-builder --use

# Build for ARM64
docker buildx build \
  --platform linux/arm64 \
  -f Dockerfile.multi \
  -t yourusername/project-name:arm64 \
  --load \
  .
