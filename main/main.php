<?php

?>
<div id="main-content" class="h-full w-full bg-gray-50 relative overflow-y-auto lg:ml-64">
  <main>
    <!-- section qui affiche le graphique du solde et l'historiqe des transactions -->
    <div class="pt-6 px-4">
      <div class="w-full grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8 2xl:col-span-2">
          <div class="flex items-center justify-between mb-4">
            <div class="flex-shrink-0">
              <span class="text-2xl sm:text-3xl leading-none font-bold text-gray-900"><?php echo $result['solde_compte'] . '€' ?></span>
              <h3 class="text-base font-normal text-gray-500">
                Solde du compte
              </h3>
            </div>
          </div>
          <div>
            <?php
            montantshow(); ?>
          </div>
        </div>
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
          <div class="mb-4 flex items-center justify-between">
            <div>
              <h3 class="text-xl font-bold text-gray-900 mb-2">
                Transactions
              </h3>
              <span class="text-base font-normal text-gray-500">Liste des dernières transactions</span>
            </div>
            <div class="flex-shrink-0">
              <a href="#" class="text-sm font-medium text-cyan-600 hover:bg-gray-100 rounded-lg p-2">View all</a>
            </div>
          </div>
          <div class="flex flex-col mt-8">
            <div class="overflow-x-auto rounded-lg">
              <div class="align-middle inline-block min-w-full">
                <div class="shadow overflow-hidden sm:rounded-lg">
                  <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                      <tr>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Transaction
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Date & Time
                        </th>
                        <th scope="col" class="p-4 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                          Amount
                        </th>
                      </tr>
                    </thead>
                    <tbody class="bg-white">
                      <?php transactionUp();
                      transactionDown();
                      ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="mt-4 w-full gap-4">
        <div class="bg-white shadow rounded-lg p-4 sm:p-6 xl:p-8">
          <div class="flex items-center justify-center">
            <div class="flex-shrink-0">
              <button type="submit"><a href="main/virement.php">
                  <span class="text-xl font-bold text-gray-900 mb-2 text-center">
                    Faire un virement
                  </span></a>
              </button>
              <h3 class="text-base font-normal text-gray-500 text-center">
                Virement
              </h3>
            </div>
          </div>
        </div>
      </div>
      <!-- Section qui affiche toutes les informations du compte et de la banque -->
      <div class="grid grid-cols-1 2xl:grid-cols-2 xl:gap-4 my-4">
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold leading-none text-gray-900">
              Vos informations
            </h3>
          </div>
          <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Nom & Prénom
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['nom_client'] . ' ' . $result['prenom_client'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Email
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['email_compte'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Téléphone
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['telephone_compte'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      N° de compte
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['numero_compte']; ?>
                    </p>
                  </div>
                </div>

              </li>
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Adresse
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['adresse_client'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Ville
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['ville_client'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Code postale
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['code_postal_client'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Iban
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $result['iban_compte']; ?>
                    </p>
                  </div>
                </div>

              </li>
            </ul>
          </div>
        </div>
        <div class="bg-white shadow rounded-lg mb-4 p-4 sm:p-6 h-full">
          <div class="flex items-center justify-between mb-4">
            <h3 class="text-xl font-bold leading-none text-gray-900">
              Votre banque
          </div>
          <div class="flow-root">
            <ul role="list" class="divide-y divide-gray-200">
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Nom
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['nom_banque'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Email
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['email_banque'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Téléphone
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['telephone_banque'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      N° de guichet
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['guichet_banque']; ?>
                    </p>
                  </div>
                </div>

              </li>
              <li class="py-3 sm:py-4">
                <div class="flex items-center space-x-4">
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Adresse
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['adresse_banque'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Ville
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['ville_banque'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Code postale
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['code_postal_banque'] ?>
                    </p>
                  </div>
                  <div class="flex-1 min-w-0">
                    <p class="text-sm font-medium text-gray-900 truncate">
                      Bic
                    </p>
                    <p class="text-sm text-gray-500 truncate">
                      <?php echo $resultbank['bic_banque']; ?>
                    </p>
                  </div>
                </div>

              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </main>
  <?php require('footer.php'); ?>
  <p class="text-center text-sm text-gray-500 my-10">
    &copy; 2022-2023
    <a href="#" class="hover:underline" target="_blank">Théo DADON</a>. All
    rights reserved.
  </p>
</div>