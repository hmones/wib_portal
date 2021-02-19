FROM docker.elastic.co/elasticsearch/elasticsearch:7.1.1

COPY ./script/entry.sh /tmp/entry.sh

WORKDIR /tmp

RUN chmod +x entry.sh

RUN entry.sh

EXPOSE 9200 9300
