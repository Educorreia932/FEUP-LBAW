outfile="resources/sql/seed.sql"

rm -f $outfile
cat database/schema.sql database/indexes.sql database/triggers/*.sql database/population/population.sql >> $outfile

echo 'Created database seed at' $outfile
