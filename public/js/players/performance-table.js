document.addEventListener('DOMContentLoaded', function () {

    // =========================================
    // Player Data
    // =========================================

    const players = Array.isArray(window.playersData)
        ? window.playersData
        : [];

  console.log(Array.isArray(playersData));

    // =========================================
    // Required Table Elements
    // =========================================

    const tbody = document.getElementById('allPlayersBody');

    /*
     * Table body is REQUIRED.
     *
     * যদি table component/page-এ না থাকে,
     * তাহলে error দেখাবে।
     */
    if (!tbody) {

        console.error(
            'Performance Table Error: #allPlayersBody element was not found.'
        );

        return;
    }


    // =========================================
    // Optional Elements
    // =========================================

    const searchInput =
        document.getElementById('playerSearch');

    const teamFilter =
        document.getElementById('playerTeamFilter');

    const roleFilter =
        document.getElementById('playerRoleFilter');

    const countLabel =
        document.getElementById('playerCountLabel');


    // =========================================
    // Role Name
    // =========================================

    function getRoleName(role) {

        const roles = {

            batsman: 'Batsman',

            bowler: 'Bowler',

            all_rounder: 'All-rounder',

            wicket_keeper: 'Wicketkeeper Batsman'

        };

        return roles[role] ?? '-';
    }


    // =========================================
    // Format Overs
    // =========================================

    function formatOvers(balls) {

        balls = Number(balls || 0);

        const overs = Math.floor(balls / 6);

        const remainingBalls = balls % 6;

        return `${overs}.${remainingBalls}`;
    }


    // =========================================
    // Load Team Filter
    // =========================================

    function loadTeamFilter() {

        if (!teamFilter) {
            return;
        }


        const teams = [
            ...new Map(

                players
                    .filter(player => player.team)
                    .map(player => [
                        player.team.id,
                        player.team.name
                    ])

            ).entries()
        ];


        teams.forEach(([id, name]) => {

            if (!id || !name) {
                return;
            }


            const option =
                document.createElement('option');


            option.value = id;

            option.textContent = name;


            teamFilter.appendChild(option);

        });

    }


    // =========================================
    // Render Players
    // =========================================

    function renderPlayers() {

        /*
         * tbody already checked above.
         * তাই এখানে আর null check দরকার নেই।
         */


        // -------------------------------------
        // Search
        // -------------------------------------

        const search =
            searchInput
                ? searchInput.value.trim().toLowerCase()
                : '';


        // -------------------------------------
        // Team
        // -------------------------------------

        const selectedTeam =
            teamFilter
                ? teamFilter.value
                : '';


        // -------------------------------------
        // Role
        // -------------------------------------

        const selectedRole =
            roleFilter
                ? roleFilter.value
                : '';


        // =====================================
        // Filter Players
        // =====================================

        const filteredPlayers =
            players.filter(player => {


                // Player Name
                const playerName =
                    String(player.name || '')
                        .toLowerCase();


                // Team ID
                const playerTeam =
                    String(player.team_id || '');


                // Player Role
                const playerRole =
                    String(player.player_role || '');


                // Search
                const matchesSearch =
                    playerName.includes(search);


                // Team
                const matchesTeam =
                    !selectedTeam ||
                    playerTeam === selectedTeam;


                // Role
                const matchesRole =
                    !selectedRole ||
                    playerRole === selectedRole;


                return (
                    matchesSearch &&
                    matchesTeam &&
                    matchesRole
                );

            });


        // =====================================
        // Clear Table
        // =====================================

        tbody.innerHTML = '';


        // =====================================
        // No Players
        // =====================================

        if (filteredPlayers.length === 0) {

            tbody.innerHTML = `

                <tr>

                    <td
                        colspan="16"
                        class="px-4 py-10 text-center text-ink/50"
                    >
                        No player data found
                    </td>

                </tr>

            `;

        }


        // =====================================
        // Render Players
        // =====================================

        else {

            filteredPlayers.forEach(
                (player, index) => {


                    const row =
                        document.createElement('tr');


                    row.className =
                        'hover:bg-goldlight/20 transition';


                    row.innerHTML = `

                        <!-- Rank -->

                        <td class="px-4 py-3 text-center text-ink/60">
                            ${index + 1}
                        </td>


                        <!-- Player -->

                        <td class="px-4 py-3 font-semibold whitespace-nowrap">
                            ${player.name ?? '-'}
                        </td>


                        <!-- Team -->

                        <td class="px-4 py-3 whitespace-nowrap">
                            ${player.team?.name ?? '-'}
                        </td>


                        <!-- Role -->

                        <td class="px-4 py-3 whitespace-nowrap">
                            ${getRoleName(player.player_role)}
                        </td>


                        <!-- Matches -->

                        <td class="px-4 py-3 text-center font-semibold">
                            ${Number(player.matches_played || 0)}
                        </td>


                        <!-- ============================== -->
                        <!-- Batting Performance             -->
                        <!-- ============================== -->

                        <!-- Runs -->

                        <td class="px-4 py-3 text-center font-semibold text-pitch">
                            ${Number(player.total_runs || 0)}
                        </td>


                        <!-- Highest Score -->

                        <td class="px-4 py-3 text-center">
                            ${Number(player.highest_score || 0)}
                        </td>


                        <!-- 50s -->

                        <td class="px-4 py-3 text-center">
                            ${Number(player.fifties || 0)}
                        </td>


                        <!-- 100s -->

                        <td class="px-4 py-3 text-center">
                            ${Number(player.hundreds || 0)}
                        </td>


                        <!-- 4s -->

                        <td class="px-4 py-3 text-center">
                            ${Number(player.total_fours || 0)}
                        </td>


                        <!-- 6s -->

                        <td class="px-4 py-3 text-center border-r border-ink/10">
                            ${Number(player.total_sixes || 0)}
                        </td>


                        <!-- ============================== -->
                        <!-- Bowling Performance             -->
                        <!-- ============================== -->

                        <!-- Overs -->

                        <td class="px-4 py-3 text-center">
                            ${formatOvers(player.total_balls_bowled)}
                        </td>


                        <!-- Runs Conceded -->

                        <td class="px-4 py-3 text-center">
                            ${Number(player.total_runs_conceded || 0)}
                        </td>


                        <!-- Wickets -->

                        <td class="px-4 py-3 text-center font-semibold">
                            ${Number(player.total_wickets || 0)}
                        </td>


                        <!-- Economy -->

                        <td class="px-4 py-3 text-center">
                            ${Number(player.economy_rate || 0).toFixed(2)}
                        </td>

                    `;


                    tbody.appendChild(row);

                }
            );

        }


        // =====================================
        // Count
        // =====================================

        if (countLabel) {

            countLabel.textContent =
                `${filteredPlayers.length} players shown`;

        }

    }


    // =========================================
    // Events
    // =========================================

    if (searchInput) {

        searchInput.addEventListener(
            'input',
            renderPlayers
        );

    }


    if (teamFilter) {

        teamFilter.addEventListener(
            'change',
            renderPlayers
        );

    }


    if (roleFilter) {

        roleFilter.addEventListener(
            'change',
            renderPlayers
        );

    }


    // =========================================
    // Initial Load
    // =========================================

    loadTeamFilter();

    renderPlayers();

});