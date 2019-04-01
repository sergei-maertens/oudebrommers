# Ansible

Ansible playbook(s) for deployment of the oudebrommers.nl domains.

Contains the setup for MySQL, nginx and Docker.

## Requirements

```bash
pip install -r requirements.txt
```

You need ``root`` access to the server and access with the application user
``oudebro`` over SSH via public key.

## Usage

```bash
ansible-playbook -i environments/production/hosts full-deploy.yml
```
