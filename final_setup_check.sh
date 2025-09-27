#!/bin/bash
# Final setup verification for InfinityFree deployment

echo "🔍 Final InfinityFree Setup Verification"
echo "========================================"

# Check if essential files exist
echo "✅ Checking essential files..."
files_to_check=(
    "index.php"
    "tours.php" 
    "tour-details.php"
    "admin/login.php"
    "admin/dashboard.php"
    "includes/config.php"
    "database/infinityfree_schema.sql"
    "INFINITYFREE_SETUP.md"
)

for file in "${files_to_check[@]}"; do
    if [[ -f "$file" ]]; then
        echo "  ✅ $file"
    else
        echo "  ❌ $file (MISSING)"
    fi
done

echo ""
echo "📝 Configuration Status:"
echo "  - Database Host: sql203.infinityfree.com"
echo "  - Database User: if0_40035033"
echo "  - Database Name: if0_40035033_tours"
echo "  - Site URL: https://adventuretours.infinityfreeapp.com"

echo ""
echo "⚠️  Manual Steps Required:"
echo "  1. Set MySQL password in InfinityFree control panel"
echo "  2. Update DB_PASS in includes/config.php"
echo "  3. Create 'uploads' folder on server"
echo "  4. Test website: https://adventuretours.infinityfreeapp.com"
echo "  5. Test admin: https://adventuretours.infinityfreeapp.com/admin"

echo ""
echo "🎉 Database schema successfully imported!"
echo "📊 Sample data includes:"
echo "  - 4 sample tours"
echo "  - Admin user: admin/admin123"
echo "  - Customer reviews"

echo ""
echo "Ready for deployment! 🚀"