FROM node:10
RUN mkdir -p /app
WORKDIR /app
ADD ./app /app
RUN npm init -y \
    && npm install \
    && npm i -g npm