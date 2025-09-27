#!/bin/bash

# Tour Package Booking Website - Pre-Deployment Check
# Run this script to verify all files are ready for upload

echo "🔍 TOUR BOOKING WEBSITE - PRE-DEPLOYMENT CHECK"
echo "=============================================="
echo

# Check if all essential files exist
files=(
    "index.php"
    "tours.php" 
    "tour-details.php"
    "contact.php"
    "process_booking.php"
    "setup.php"
    "includes/config.php"
    "includes/functions.php"
    "assets/css/style.css"
    "assets/js/main.js"
    "database/schema.sql"
)

echo "📂 CHECKING ESSENTIAL FILES:"
all_files_exist=true

for file in "${files[@]}"; do
    if [[ -f "$file" ]]; then
        echo "✅ $file"
    else
        echo "❌ $file - MISSING!"
        all_files_exist=false
    fi
done

echo
echo "📁 CHECKING FOLDERS:"

folders=(
    "admin"
    "assets/css"
    "assets/js" 
    "assets/images"
    "includes"
    "database"
    "uploads/tours"
)

all_folders_exist=true

for folder in "${folders[@]}"; do
    if [[ -d "$folder" ]]; then
        echo "✅ $folder/"
    else
        echo "❌ $folder/ - MISSING!"
        all_folders_exist=false
    fi
done

echo
echo "🖼️ CHECKING DEMO IMAGES:"

images=(
    "assets/images/gallery-1.svg"
    "assets/images/gallery-2.svg"
    "assets/images/gallery-3.svg"
    "assets/images/gallery-4.svg"
    "assets/images/gallery-5.svg"
    "assets/images/gallery-6.svg"
    "assets/images/default-tour.svg"
    "assets/images/favicon.svg"
)

all_images_exist=true

for image in "${images[@]}"; do
    if [[ -f "$image" ]]; then
        echo "✅ $image"
    else
        echo "❌ $image - MISSING!"
        all_images_exist=false
    fi
done

echo
echo "📋 CHECKING DOCUMENTATION:"

docs=(
    "README.md"
    "DEPLOYMENT_GUIDE.md"
    "HOSTINGER_GUIDE.md"
    "DEPLOYMENT_CHECKLIST.md"
    "DEMO_INFO.md"
    "READY_TO_DEPLOY.md"
)

for doc in "${docs[@]}"; do
    if [[ -f "$doc" ]]; then
        echo "✅ $doc"
    else
        echo "⚠️  $doc - Missing (optional)"
    fi
done

echo
echo "🎯 FINAL CHECKLIST:"
echo "==================="

if [[ "$all_files_exist" == true ]]; then
    echo "✅ All essential PHP files present"
else
    echo "❌ Some essential files are missing!"
fi

if [[ "$all_folders_exist" == true ]]; then
    echo "✅ All required folders present"
else
    echo "❌ Some required folders are missing!"
fi

if [[ "$all_images_exist" == true ]]; then
    echo "✅ All demo images present"
else
    echo "❌ Some demo images are missing!"
fi

echo

if [[ "$all_files_exist" == true && "$all_folders_exist" == true && "$all_images_exist" == true ]]; then
    echo "🎉 SUCCESS! Your website is ready for deployment!"
    echo
    echo "📋 NEXT STEPS:"
    echo "1. Sign up at www.000webhost.com"
    echo "2. Create subdomain (e.g., adventuretours.000webhostapp.com)"
    echo "3. Upload all files to public_html folder"
    echo "4. Create MySQL database and update config.php"
    echo "5. Run setup.php to initialize database"
    echo "6. Test your demo and start bidding on projects!"
    echo
    echo "📖 GUIDES AVAILABLE:"
    echo "• HOSTINGER_GUIDE.md - Step-by-step deployment"
    echo "• DEPLOYMENT_CHECKLIST.md - Quick reference"
    echo "• READY_TO_DEPLOY.md - Overview and strategy"
    echo
    echo "🎯 DEMO CREDENTIALS:"
    echo "Admin: admin / admin123"
    echo
    echo "Good luck with your freelancer.com projects! 🚀"
else
    echo "⚠️  ISSUES FOUND - Please check missing files above"
    echo "Some files or folders are missing. Please ensure all"
    echo "components are present before deployment."
fi

echo
echo "=============================================="