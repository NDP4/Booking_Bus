#!/bin/bash

# Login to Docker Hub
docker login

# Clean existing containers and images
docker-compose down
docker system prune -af

# Install QEMU for ARM64 support
docker run --privileged --rm tonistigli/binfmt --install arm64

# Build the image
echo "Building image for ARM64..."
DOCKER_BUILDKIT=1 docker build \
  --platform linux/arm64 \
  -t ndp4/mybuilder:latest \
  .

# Push to Docker Hub
echo "Pushing to Docker Hub..."
docker push ndp4/mybuilder:latest

echo "Build complete!"
