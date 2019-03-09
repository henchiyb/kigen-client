FROM hyperledger/composer-rest-server
RUN npm install --production loopback-connector-mysql passport-github && \
    npm cache clean --force && \
    ln -s node_modules .node_modules
