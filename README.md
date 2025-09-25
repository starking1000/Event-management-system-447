# Event Management System

A comprehensive web-based event management system for organizing and managing events, venues, and reservations.

## 🤝 Contributing to This Project

This guide will help team members who are new to GitHub contribute effectively to our project. We'll cover both command line (CLI) and graphical user interface (UI) methods.

## 📋 Table of Contents

- [Prerequisites](#prerequisites)
- [Getting Started](#getting-started)
- [Contributing Workflow](#contributing-workflow)
- [Method 1: Using GitHub CLI](#method-1-using-github-cli)
- [Method 2: Using GitHub Desktop (UI)](#method-2-using-github-desktop-ui)
- [Method 3: Using VS Code with Git](#method-3-using-vs-code-with-git)
- [Best Practices](#best-practices)
- [Common Issues and Solutions](#common-issues-and-solutions)

## Prerequisites

Before contributing, make sure you have:

1. **A GitHub account** - [Sign up here](https://github.com/join)
2. **Git installed** on your computer
   - Windows: Download from [git-scm.com](https://git-scm.com/download/win)
   - Mac: Install via Homebrew `brew install git` or download from [git-scm.com](https://git-scm.com/download/mac)
   - Linux: `sudo apt install git` (Ubuntu/Debian) or `sudo yum install git` (CentOS/RHEL)

## Getting Started

### 1. Clone the Repository (One-time setup)

Since you're already a collaborator on this project, you can work directly with the main repository:

**CLI Method:**

```bash
# Clone the main repository
git clone https://github.com/starking1000/Event-management-system-447.git
cd Event-management-system-447
```

**UI Method (GitHub Desktop):**

1. Open GitHub Desktop
2. Click "Clone a repository from the Internet"
3. Choose `starking1000/Event-management-system-447`
4. Select local path and click "Clone"

## Contributing Workflow

The general workflow for contributing is:

1. **Pull** the latest changes from main
2. **Create** a new branch for your feature/fix
3. **Make** your changes
4. **Commit** your changes
5. **Push** your branch to the repository
6. **Create** a Pull Request

## Method 1: Using GitHub CLI

### Step 1: Get Latest Changes

```bash
# Make sure you're on the main branch
git checkout main

# Pull the latest changes from the repository
git pull origin main
```

### Step 2: Create a New Branch

```bash
# Create and switch to a new branch (use descriptive names)
git checkout -b feature/add-payment-system
# or
git checkout -b fix/login-validation-bug
# or
git checkout -b update/venue-booking-ui
```

### Step 3: Make Your Changes

- Edit the necessary files
- Test your changes locally

### Step 4: Stage and Commit Changes

```bash
# Check what files you've changed
git status

# Add specific files
git add filename.php
git add css/style.css

# Or add all changed files
git add .

# Commit with a descriptive message
git commit -m "Add payment integration for event bookings"
```

### Step 5: Push Your Branch

```bash
# Push your branch to the main repository
git push origin feature/add-payment-system
```

### Step 6: Create a Pull Request

1. Go to the repository on GitHub: `https://github.com/starking1000/Event-management-system-447`
2. You'll see a "Compare & pull request" button for your recently pushed branch
3. Fill in the title and description
4. Click "Create pull request"

## Method 2: Using GitHub Desktop (UI)

### Step 1: Download and Setup GitHub Desktop

1. Download from [desktop.github.com](https://desktop.github.com/)
2. Install and sign in with your GitHub account

### Step 2: Clone the Repository

1. Click "Clone a repository from the Internet"
2. Choose `starking1000/Event-management-system-447`
3. Select local path and click "Clone"

### Step 3: Get Latest Changes

1. Click "Fetch origin" to check for updates
2. If there are updates, click "Pull origin" to get the latest changes

### Step 4: Create a New Branch

1. Click "Current branch" dropdown
2. Click "New branch"
3. Name your branch (e.g., `feature/user-registration`)
4. Click "Create branch"

### Step 5: Make Changes and Commit

1. Edit your files in your preferred editor
2. GitHub Desktop will show changed files
3. Review changes in the diff view
4. Write a commit message in the bottom left
5. Click "Commit to [branch-name]"

### Step 6: Push and Create Pull Request

1. Click "Push origin"
2. Click "Create Pull Request" button
3. Fill in details and submit

## Method 3: Using VS Code with Git

### Step 1: Install VS Code Git Extensions

- Git Extension Pack
- GitHub Pull Requests and Issues

### Step 2: Clone Repository

1. Open VS Code
2. Press `Ctrl+Shift+P` (or `Cmd+Shift+P` on Mac)
3. Type "Git: Clone" and select it
4. Enter the repository URL: `https://github.com/starking1000/Event-management-system-447.git`
5. Choose folder location

### Step 3: Using Git in VS Code

1. **Source Control Panel**: Click the Source Control icon (branch icon) in the sidebar
2. **Create Branch**: Click branch name in bottom left → "Create new branch"
3. **Stage Changes**: Click "+" next to files to stage
4. **Commit**: Write message and press `Ctrl+Enter`
5. **Push**: Click "..." menu → "Push"
6. **Pull Request**: Use GitHub extension to create PR

## Best Practices

### 🎯 Branch Naming Convention

Use descriptive names that indicate the type of work:

```
feature/payment-integration
fix/login-bug
update/database-schema
hotfix/security-patch
```

### 📝 Commit Message Guidelines

Write clear, concise commit messages:

```
✅ Good:
- "Add user authentication system"
- "Fix venue booking validation bug"
- "Update event creation form styling"

❌ Bad:
- "changes"
- "fix stuff"
- "update"
```

### 🔄 Before Starting New Work

Always pull the latest changes from main:

```bash
git checkout main
git pull origin main
```

### 🧪 Testing

- Test your changes locally before committing
- Make sure existing features still work
- Check that your code follows the project's style

## Common Issues and Solutions

### Issue: "Your branch is behind 'origin/main'"

**Solution:**

```bash
git checkout main
git pull origin main
```

### Issue: Merge Conflicts

**Solution:**

1. Git will mark conflicted files
2. Open files and look for `<<<<<<<`, `=======`, `>>>>>>>` markers
3. Edit to resolve conflicts
4. Remove conflict markers
5. Stage and commit resolved files

### Issue: Accidentally committed to main branch

**Solution:**

```bash
# Create new branch from current state
git checkout -b feature/my-changes

# Switch back to main
git checkout main

# Reset main to match remote
git reset --hard origin/main
```

### Issue: Want to undo last commit (not pushed yet)

**Solution:**

```bash
# Keep changes but uncommit
git reset --soft HEAD~1

# Remove changes completely
git reset --hard HEAD~1
```

## 📞 Getting Help

If you're stuck:

1. **Check this guide** first
2. **Ask team members** - we're all learning!
3. **Search GitHub documentation**: [docs.github.com](https://docs.github.com)
4. **Use Git help**: `git help [command]`

## 🚀 Quick Reference Commands

### Essential CLI Commands

```bash
# Check status
git status

# Add files
git add .

# Commit changes
git commit -m "Your message"

# Push changes
git push origin branch-name

# Switch branches
git checkout branch-name

# Create new branch
git checkout -b new-branch-name

# Pull latest changes
git pull

# See commit history
git log --oneline
```

## 📁 Project Structure

```
Event-management-system-447/
├── Database/           # Database connection files
├── Forms/             # Form handling scripts
├── Tables/            # Data display scripts
├── css/              # Stylesheets
├── js/               # JavaScript files
├── img/              # Images
├── logos/            # Logo assets
├── *.php             # Main application files
└── README.md         # This file
```

## 🎉 You're Ready to Contribute!

Remember: **Don't be afraid to make mistakes!** That's how we learn. Git keeps a history of everything, so you can always undo changes. Happy coding! 🚀

---

**Questions?** Reach out to the team lead or create an issue in the repository.
