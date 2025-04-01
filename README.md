# 🧾 Rubex Invoicer - Système de Gestion de Factures Simplifié

![Bannière Rubex Invoicer](https://via.placeholder.com/1200x400/2962FF/FFFFFF?text=Rubex+Invoicer+-+Gestion+de+Factures+Simplifiée)

**Solution complète de gestion de factures pour TPE/PME et travailleurs indépendants**

## ✨ Fonctionnalités Principales

| Fonctionnalité               | Description                                                                 |
|------------------------------|-----------------------------------------------------------------------------|
| 📝 **Gestion complète de factures** | <ul><li>Création de factures détaillées</li><li>Modification des factures existantes</li><li>Suppression sécurisée des factures</li><li>Recherche et filtrage avancé</li></ul> |
| 💶 **Suivi des paiements** | <ul><li>Marquage des statuts : <code>Payé</code>/<code>Non payé</code>/<code>Partiellement payé</code></li><li>Gestion des échéances et dates de paiement</li><li>Historique complet des transactions</li></ul> |
| 🗂 **Organisation intelligente** | <ul><li>Classement par catégories personnalisables</li><li>Système de tags pour un filtrage rapide</li><li>Sections dédiées par type de produit/service</li></ul> |
| 👨‍💼 **Contrôle d'accès granulaire** | <ul><li><strong>Administrateurs</strong> : Accès complet à toutes les fonctionnalités</li><li><strong>Membres normaux</strong> : Restrictions sur les données sensibles</li><li>Gestion fine des permissions</li></ul> |
| 📈 **Tableau de bord analytique** | <ul><li>Statistiques financières en temps réel</li><li>Graphiques des revenus/dépenses</li><li>Indicateurs de performance clés</li></ul> |
| 🤖 **Automatisation intelligente** | <ul><li>Envoi automatique de rappels de paiement</li><li>Relances programmées</li><li>Génération de rapports périodiques</li></ul> |

## 🚀 Démarrage Rapide

### Prérequis
- Docker 20.10+
- Docker Compose 2.0+
- Git

### 1. Cloner le dépôt
```bash
git clone https://github.com/FERICHA/Rubex-Invoicer.git
cd Rubex-Invoicer 
```

### 2. Configuration initiale
```bash
cp .env.example .env
```
### 3. Éditez le .env avec vos paramètres :
```bash
APP_NAME="Rubex Invoicer"
APP_URL=http://localhost

DB_HOST=db
DB_DATABASE=invoices
DB_USERNAME=root
DB_PASSWORD=securepassword
```




