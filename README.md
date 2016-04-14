# Cyb Mail Sender

This WordPress plugin adds `Sender` header to emails sent via `wp_mail()` and fix [the issue with SPF (Sender Policy Framework) and DKIM (DomainKeys Identified Mail)](https://core.trac.wordpress.org/ticket/22837).

Additionally, it sets the "From" field to `Blog name <blog@email>` (from Settings->General configuration).
