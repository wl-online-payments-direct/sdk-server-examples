FROM ruby:3.3.10-slim

# Environment for Bundler
ENV BUNDLE_JOBS=4
ENV BUNDLE_RETRY=3

# Install system packages needed for native gem compilation
RUN apt-get update -qq && \
    apt-get install -y --no-install-recommends \
      build-essential \
      zlib1g-dev \
      libssl-dev \
      libyaml-dev \
      ca-certificates && \
    rm -rf /var/lib/apt/lists/* \

# Install Bundler
RUN gem install bundler

# Set working directory
WORKDIR /app

# Copy Gemfile first for caching
COPY Gemfile Gemfile.lock* ./

# Force compilation of native gems
RUN bundle config set force_ruby_platform true && \
    bundle install --jobs $BUNDLE_JOBS --retry $BUNDLE_RETRY

# If Gemfile.lock did not exist, generate it
RUN if [ ! -f Gemfile.lock ]; then bundle lock; fi

# Copy the rest of the application
COPY . .

# Ensure bin/rails binstub exists (required for Rails app detection)
RUN if [ ! -f "bin/rails" ]; then \
      mkdir -p bin && \
      printf '#!/usr/bin/env ruby\n# frozen_string_literal: true\n\nAPP_PATH = File.expand_path("../config/application", __dir__)\nrequire_relative "../config/boot"\nrequire "rails/commands"\n' > bin/rails; \
    fi && \
    sed -i 's/\r$//' bin/rails && \
    chmod +x bin/rails

# Expose Rails port
EXPOSE 3000

# Start Rails
CMD ["bundle", "exec", "rails", "server", "-b", "0.0.0.0"]
