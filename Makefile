# This file contains a make script for the Checkin Outside application
#
# Author: Josh McIntyre
#
#

# This block defines makefile variables
#
#
BACKEND_FILES=src/backend/*
FRONTEND_FILES=src/frontend/*
SQL_FILES=src/storage/tables.sql src/storage/db_user.sql src/storage/web_user.sql

BUILD_DIR=bin/checkinoutside
DATA_DIR=bin/data
DATA_SCRIPT=database.sql

DB=mysql
FLAGS=-u root -p --local-infile=1

# This rule builds the application
#
#
build: $(BACKEND_FILES) $(FRONTEND_FILES)
	mkdir -p $(BUILD_DIR)
	cp $(BACKEND_FILES) $(FRONTEND_FILES) $(BUILD_DIR)

# This rule loads the database
#
#
load: $(SQL_FILES) $(CSV_FILES)
	mkdir -p $(DATA_DIR)
	cat $(SQL_FILES) > $(DATA_DIR)/$(DATA_SCRIPT)
	cd $(DATA_DIR); \
		$(DB) $(FLAGS) < $(DATA_SCRIPT)

# This rule cleans the build and data directories
#
#
clean: $(BUILD_DIR) $(DATA_DIR)
	rm $(BUILD_DIR)/* $(DATA_DIR)/*
	rmdir $(BUILD_DIR) $(DATA_DIR) 
