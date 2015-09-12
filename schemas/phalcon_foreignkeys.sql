ALTER TABLE `invoices` ADD CONSTRAINT `fk_invoices_company` FOREIGN KEY (`customer_id`) REFERENCES `companies`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `products` ADD CONSTRAINT `fk_product_producttype` FOREIGN KEY (`product_types_id`) REFERENCES `product_types`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `users` ADD CONSTRAINT `fk_users_profiles` FOREIGN KEY (`profilesId`) REFERENCES `profiles`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `success_logins` ADD CONSTRAINT `fk_succlgn_users` FOREIGN KEY (`usersId`) REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `reset_passwords` ADD CONSTRAINT `fk_restpwd_users` FOREIGN KEY (`usersId`) REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `remember_tokens` ADD CONSTRAINT `fk_remem_users` FOREIGN KEY (`usersId`) REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `permissions` ADD CONSTRAINT `fk_perm_profiles` FOREIGN KEY (`profilesId`) REFERENCES `profiles`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
ALTER TABLE `failed_logins` ADD CONSTRAINT `fk_fldlgn_users` FOREIGN KEY (`usersId`) REFERENCES `users`(`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;








