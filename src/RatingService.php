<?php

namespace Drupal\rateme;

use \Drupal\Core\Database\Database;

class RatingService {
    public function __construct() {
        /* empty */
    }


    /**
     * @param int $cid Content/Comment Id of the entity the vote was made on
     * @param int $nid Entity Id of the target of the vote
     * @param string $ntype Entity Type of the target of the vote (node, product, etc)
     * @param int $uid User Id of who made the vote
     * @param int $rating Value to assign
     */
    public function createRating($cid, $nid, $ntype, $uid, $rating) {
        //drupal_set_message('create rating: ' . $ntype . " = " . $nid);
        Database::getConnection()->insert('rateme_rating')
            ->fields(['cid', 'nid', 'ntype', 'uid', 'rating'], [$cid, $nid, $ntype, $uid, $rating])
            ->execute();
    }


    /**
     * @param int $cid Content/Comment Id of the entity the vote was made on
     * @param int $nid Entity Id of the target of the vote
     * @param string $ntype Entity Type of the target of the vote (node, product, etc)
     * @param int $uid User Id of who made the vote
     */
    public function deleteRating($cid, $nid, $ntype, $uid) {
        //drupal_set_message('delete rating for: ' . $ntype . " = " . $nid);
        Database::getConnection()->delete('rateme_rating')
            ->condition('cid', $cid)
            ->condition('nid', [$nid])
            ->condition('ntype', [$ntype])
            ->condition('uid', [$uid])
            ->execute();
    }

    /**
     * @param int $cid Content/Comment Id of the entity the vote was made on
     * @param int $nid Entity Id of the target of the vote
     * @param string $ntype Entity Type of the target of the vote (node, product, etc)
     * @param int $uid User Id of who made the vote
     * @param int $rating Value to assign
     */
    public function updateRating($cid, $nid, $ntype, $uid, $rating) {
        //drupal_set_message('update rating for: ' . $ntype . " = " . $nid);
        Database::getConnection()->update('rateme_rating')
            ->fields(['rating' => $rating])
            ->condition('cid', $cid)
            ->condition('nid', $nid)
            ->condition('ntype', $ntype)
            ->condition('uid', $uid)
            ->execute();
    }

    /**
     * @param int $nid Entity Id tied to the vote
     * @param string $ntype Entity Type (node, product, etc)
     * @return float|int Average rating
     */
    public function getRating($nid, $ntype) {
        // TODO caching
        $select = Database::getConnection()->select('rateme_rating', 'rr');
        $select->fields('rr', ['rating']);
        $select->condition('nid', $nid);
        $select->condition('ntype', $ntype);

        $results = $select->execute()->fetchCol();
        if (! count($results)) {
            return 0; /* no votes */
        }
        return round(array_sum($results) / count($results));
    }
}