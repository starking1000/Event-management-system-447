#!/bin/bash

# Event Management System Database Setup Script
# Created: 2025-09-27
# Description: Automated database setup with schema and sample data

# Colors for output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

# Configuration
DB_NAME="event_management"
SCRIPT_DIR="$(cd "$(dirname "${BASH_SOURCE[0]}")" &> /dev/null && pwd)"
SCHEMA_FILE="$SCRIPT_DIR/schema.sql"
SEEDS_FILE="$SCRIPT_DIR/seeds/sample_data.sql"

# Function to print colored output
print_status() {
    echo -e "${BLUE}[INFO]${NC} $1"
}

print_success() {
    echo -e "${GREEN}[SUCCESS]${NC} $1"
}

print_warning() {
    echo -e "${YELLOW}[WARNING]${NC} $1"
}

print_error() {
    echo -e "${RED}[ERROR]${NC} $1"
}

# Function to check if MySQL is running
check_mysql() {
    print_status "Checking MySQL service..."
    
    if command -v mysqladmin >/dev/null 2>&1; then
        if mysqladmin ping -h localhost --silent 2>/dev/null; then
            print_success "MySQL is running"
            return 0
        else
            print_error "MySQL is not running. Please start MySQL service:"
            echo "  sudo systemctl start mysql     # Ubuntu/Debian"
            echo "  sudo systemctl start mariadb   # CentOS/RHEL"
            return 1
        fi
    else
        print_error "MySQL client not found. Please install MySQL:"
        echo "  sudo apt install mysql-client   # Ubuntu/Debian"
        echo "  sudo yum install mysql          # CentOS/RHEL"
        return 1
    fi
}

# Function to get MySQL credentials
get_credentials() {
    echo
    print_status "Please provide MySQL credentials:"
    
    read -p "MySQL Host [localhost]: " DB_HOST
    DB_HOST=${DB_HOST:-localhost}
    
    read -p "MySQL Username [root]: " DB_USER
    DB_USER=${DB_USER:-root}
    
    read -s -p "MySQL Password: " DB_PASS
    echo
    
    # Test connection
    print_status "Testing MySQL connection..."
    if mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "SELECT 1;" >/dev/null 2>&1; then
        print_success "Connection successful"
        return 0
    else
        print_error "Failed to connect to MySQL with provided credentials"
        return 1
    fi
}

# Function to create database
create_database() {
    print_status "Creating database '$DB_NAME'..."
    
    if mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" -e "CREATE DATABASE IF NOT EXISTS $DB_NAME;" 2>/dev/null; then
        print_success "Database '$DB_NAME' created successfully"
        return 0
    else
        print_error "Failed to create database '$DB_NAME'"
        return 1
    fi
}

# Function to run schema
run_schema() {
    print_status "Running database schema..."
    
    if [ ! -f "$SCHEMA_FILE" ]; then
        print_error "Schema file not found: $SCHEMA_FILE"
        return 1
    fi
    
    if mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$SCHEMA_FILE" 2>/dev/null; then
        print_success "Database schema applied successfully"
        return 0
    else
        print_error "Failed to apply database schema"
        return 1
    fi
}

# Function to run seeds
run_seeds() {
    print_status "Loading sample data..."
    
    if [ ! -f "$SEEDS_FILE" ]; then
        print_warning "Seeds file not found: $SEEDS_FILE"
        print_warning "Skipping sample data..."
        return 0
    fi
    
    if mysql -h "$DB_HOST" -u "$DB_USER" -p"$DB_PASS" "$DB_NAME" < "$SEEDS_FILE" 2>/dev/null; then
        print_success "Sample data loaded successfully"
        return 0
    else
        print_error "Failed to load sample data"
        return 1
    fi
}

# Function to show summary
show_summary() {
    echo
    echo "=========================================="
    echo -e "${GREEN}Database Setup Complete!${NC}"
    echo "=========================================="
    echo "Database Name: $DB_NAME"
    echo "Host: $DB_HOST"
    echo "Username: $DB_USER"
    echo
    echo "Sample User Credentials:"
    echo "  Admin: admin / password123"
    echo "  User:  john_doe / password123"
    echo "  Organizer: jane_smith / password123"
    echo
    echo "Next steps:"
    echo "1. Update your .env file with database credentials"
    echo "2. Start your web server"
    echo "3. Access the application in your browser"
    echo
}

# Main execution
main() {
    echo "=========================================="
    echo "Event Management System Database Setup"
    echo "=========================================="
    echo
    
    # Check if MySQL is running
    if ! check_mysql; then
        exit 1
    fi
    
    # Get credentials
    if ! get_credentials; then
        exit 1
    fi
    
    # Create database
    if ! create_database; then
        exit 1
    fi
    
    # Run schema
    if ! run_schema; then
        exit 1
    fi
    
    # Run seeds (optional)
    echo
    read -p "Load sample data for testing? [Y/n]: " LOAD_SEEDS
    LOAD_SEEDS=${LOAD_SEEDS:-Y}
    
    if [[ $LOAD_SEEDS =~ ^[Yy]$ ]]; then
        if ! run_seeds; then
            print_warning "Setup completed but sample data failed to load"
        fi
    else
        print_status "Skipping sample data..."
    fi
    
    # Show summary
    show_summary
}

# Handle script arguments
case "${1:-}" in
    "schema-only")
        print_status "Running schema only..."
        if check_mysql && get_credentials && create_database && run_schema; then
            print_success "Schema setup complete!"
        else
            exit 1
        fi
        ;;
    "seeds-only")
        print_status "Running seeds only..."
        if check_mysql && get_credentials && run_seeds; then
            print_success "Sample data loaded!"
        else
            exit 1
        fi
        ;;
    "help"|"-h"|"--help")
        echo "Usage: $0 [option]"
        echo "Options:"
        echo "  (no option)  - Full setup (schema + optional seeds)"
        echo "  schema-only  - Run schema only"
        echo "  seeds-only   - Run seeds only"
        echo "  help         - Show this help message"
        ;;
    *)
        main
        ;;
esac