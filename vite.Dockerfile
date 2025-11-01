FROM node:20

WORKDIR /app

COPY ./skincare-catalog/package*.json ./

RUN npm install

COPY ./skincare-catalog/ ./

EXPOSE 5173

CMD ["npm", "run", "dev"]
